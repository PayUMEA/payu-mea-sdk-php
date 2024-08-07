<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Data;

use ArrayAccess;
use InvalidArgumentException;
use PayUSdk\Framework\Exception\LocalizedException;
use PayUSdk\Framework\Serialize\JsonConverter;

/**
 * Universal data container with array access implementation
 *
 * @api
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
class DataObject implements ArrayAccess
{
    /**
     * Object attributes
     *
     * @var array
     */
    protected array $_data = [];

    /**
     * Setter/Getter underscore transformation cache
     *
     * @var array
     */
    protected static array $_underscoreCache = [];

    /**
     * Constructor
     *
     * By default, is looking for first argument as array and assigns it as object attributes
     * This behavior may change in child classes
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->_data = $data;
    }

    /**
     * Add data to the object.
     *
     * Retains previous data in the object.
     *
     * @param array $arr
     * @return $this
     */
    public function addData(array $arr): static
    {
        if ($this->_data === []) {
            $this->setData($arr);
            return $this;
        }

        foreach ($arr as $index => $value) {
            $this->setData($index, $value);
        }

        return $this;
    }

    /**
     * Overwrite data in the object.
     *
     * The $key parameter can be string or array.
     * If $key is string, the attribute value will be overwritten by $value
     *
     * If $key is an array, it will overwrite all the data in the object.
     *
     * @param array|string $key
     * @param mixed|null $value
     * @return $this
     */
    public function setData(array|string $key, mixed $value = null): static
    {
        if ($key === (array)$key) {
            $this->_data = $key;
        } else {
            $this->_data[$key] = $value;
        }

        return $this;
    }

    /**
     * Unset data from the object.
     *
     * @param array|string|null $key
     * @return $this
     */
    public function unsetData(array|string $key = null): static
    {
        if ($key === null) {
            $this->setData([]);
        } elseif (is_string($key)) {
            if (isset($this->_data[$key]) || array_key_exists($key, $this->_data)) {
                unset($this->_data[$key]);
            }
        } elseif ($key === (array)$key) {
            foreach ($key as $element) {
                $this->unsetData($element);
            }
        }

        return $this;
    }

    /**
     * Object data getter
     *
     * If $key is not defined will return all the data as an array.
     * Otherwise, it will return value of the element specified by $key.
     * It is possible to use keys like a/b/c for access nested array data
     *
     * If $index is specified it will assume that attribute data is an array
     * and retrieve corresponding member. If data is the string - it will be exploded
     * by new line character and converted to array.
     *
     * @param string $key
     * @param int|string|null $index
     * @return mixed
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function getData(string $key = '', int|string $index = null): mixed
    {
        if ('' === $key) {
            return $this->_data;
        }

        /* process a/b/c key as ['a']['b']['c'] */
        if ($key !== null && str_contains($key, '/')) {
            $data = $this->getDataByPath($key);
        } else {
            $data = $this->_getData($key);
        }

        if ($index !== null) {
            if ($data === (array)$data) {
                $data = $data[$index] ?? null;
            } elseif (is_string($data)) {
                $data = explode(PHP_EOL, $data);
                $data = $data[$index] ?? null;
            } elseif ($data instanceof DataObject) {
                $data = $data->getData($index);
            } else {
                $data = null;
            }
        }

        return $data;
    }

    /**
     * Get object data by path
     *
     * Method consider the path as chain of keys: a/b/c => ['a']['b']['c']
     *
     * @param string $path
     * @return mixed
     */
    public function getDataByPath(string $path): mixed
    {
        $keys = explode('/', (string)$path);

        $data = $this->_data;

        foreach ($keys as $key) {
            if ((array)$data === $data && isset($data[$key])) {
                $data = $data[$key];
            } elseif ($data instanceof DataObject) {
                $data = $data->getDataByKey($key);
            } else {
                return null;
            }
        }

        return $data;
    }

    /**
     * Get object data by particular key
     *
     * @param string $key
     * @return mixed
     */
    public function getDataByKey(string $key): mixed
    {
        return $this->_getData($key);
    }

    /**
     * Get value from _data array without parse key
     *
     * @param string $key
     * @return  mixed
     */
    protected function _getData(string $key): mixed
    {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }

        return null;
    }

    /**
     * Set object data with calling setter method
     *
     * @param string $key
     * @param mixed|array $args
     * @return $this
     */
    public function setDataUsingMethod(string $key, array $args = []): static
    {
        $method = 'set' . ($key !== null ? str_replace('_', '', ucwords($key, '_')) : '');
        $this->{$method}($args);

        return $this;
    }

    /**
     * Get object data by key with calling getter method
     *
     * @param string $key
     * @param mixed|null $args
     * @return mixed
     */
    public function getDataUsingMethod(string $key, mixed $args = null): mixed
    {
        $method = 'get' . ($key !== null ? str_replace('_', '', ucwords($key, '_')) : '');

        return $this->{$method}($args);
    }

    /**
     * If $key is empty, checks whether there's any data in the object
     *
     * Otherwise, checks if the specified attribute is set.
     *
     * @param string $key
     * @return bool
     */
    public function hasData(string $key = ''): bool
    {
        if (empty($key) || !is_string($key)) {
            return !empty($this->_data);
        }

        return array_key_exists($key, $this->_data);
    }

    /**
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = []): array
    {
        if (empty($keys)) {
            return $this->traverseArray($this->_data);
        }

        $result = [];

        foreach ($keys as $key) {
            if (isset($this->_data[$key])) {
                $result[$key] = $this->_data[$key];
            } else {
                $result[$key] = null;
            }
        }

        return $result;
    }

    /**
     * @param array $data
     * @return array
     */
    public function traverseArray(array $data = []): array
    {
        $array = [];

        foreach ($data as $key => $value) {
            if ($value instanceof DataObject) {
                $array[$key] = $value->toArray();
            } elseif (is_array($value) && count($value) <= 0) {
                $array[$key] = [];
            } elseif (is_array($value)) {
                $array[$key] = $this->traverseArray($value);
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    /**
     * The "__" style wrapper for toArray method
     *
     * @param  array $keys
     * @return array
     */
    public function convertToArray(array $keys = []): array
    {
        return $this->toArray($keys);
    }

    /**
     * Convert nested array into flat array.
     *
     * @param array $data
     * @return array
     */
    public static function toFlatArray($data = [])
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = self::toFlatArray($value);
                unset($data[$key]);
                $data = array_merge($data, $value);
            }
        }
        return $data;
    }

    /**
     * Convert object data to JSON
     *
     * @param array $keys array of required keys
     * @return bool|string
     * @throws InvalidArgumentException
     */
    public function toJson(array $keys = []): bool|string
    {
        $data = $this->toArray($keys);

        return JsonConverter::convert($data);
    }

    /**
     * The "__" style wrapper for toJson
     *
     * @param array $keys
     * @return bool|string
     * @throws InvalidArgumentException
     */
    public function convertToJson(array $keys = []): bool|string
    {
        return $this->toJson($keys);
    }

    /**
     * Convert object data into string with predefined format
     *
     * Will use $format as a template and substitute {{key}} for attributes
     *
     * @param string $format
     * @return string
     */
    public function toString(string $format = ''): string
    {
        if (empty($format)) {
            $result = implode(', ', $this->getData());
        } else {
            preg_match_all('/\{\{([a-z0-9_]+)\}\}/is', $format, $matches);
            foreach ($matches[1] as $var) {
                $data = $this->getData($var) ?? '';
                $format = str_replace('{{' . $var . '}}', $data, $format);
            }
            $result = $format;
        }

        return $result;
    }

    /**
     * Set/Get attribute wrapper
     *
     * @param string $method
     * @param array $args
     * @return mixed
     * @throws LocalizedException
     */
    public function __call(string $method, array $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                $key = $this->_underscore(substr($method, 3));
                $index = $args[0] ?? null;

                return $this->getData($key, $index);
            case 'set':
                $key = $this->_underscore(substr($method, 3));
                $value = $args[0] ?? null;

                return $this->setData($key, $value);
            case 'uns':
                $key = $this->_underscore(substr($method, 3));

                return $this->unsetData($key);
            case 'has':
                $key = $this->_underscore(substr($method, 3));

                return isset($this->_data[$key]);
        }

        throw new LocalizedException(
            sprintf('Invalid method %1::%2', get_class($this), $method)
        );
    }

    /**
     * Checks whether the object is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        if (empty($this->_data)) {
            return true;
        }

        return false;
    }

    /**
     * Converts field names for setters and getters
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     * Uses cache to eliminate unnecessary preg_replace
     *
     * @param string $name
     * @return string
     */
    protected function _underscore(string $name): string
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }

        $result = strtolower(trim(preg_replace('/([A-Z]|[0-9]+)/', "_$1", $name), '_'));
        self::$_underscoreCache[$name] = $result;

        return $result;
    }

    /**
     * Convert object data into string with defined keys and values.
     *
     * Example: key1="value1" key2="value2" ...
     *
     * @param array $keys array of accepted keys
     * @param string $valueSeparator separator between key and value
     * @param string $fieldSeparator separator between key/value pairs
     * @param string $quote quoting sign
     * @return  string
     */
    public function serialize(
        array $keys = [],
        string $valueSeparator = '=',
        string $fieldSeparator = ' ',
        string $quote = '"'
    ): string
    {
        $data = [];

        if (empty($keys)) {
            $keys = array_keys($this->_data);
        }

        foreach ($this->_data as $key => $value) {
            if (in_array($key, $keys)) {
                $data[] = $key . $valueSeparator . $quote . $value . $quote;
            }
        }

        return implode($fieldSeparator, $data);
    }

    /**
     * Present object data as string in debug mode
     *
     * @param mixed|null $data
     * @param array $objects
     * @return array|string
     */
    public function debug(mixed $data = null, array &$objects = []): array|string
    {
        if ($data === null) {
            $hash = spl_object_hash($this);

            if (!empty($objects[$hash])) {
                return '*** RECURSION ***';
            }

            $objects[$hash] = true;
            $data = $this->getData();
        }

        $debug = [];

        foreach ($data as $key => $value) {
            if (is_scalar($value)) {
                $debug[$key] = $value;
            } elseif (is_array($value)) {
                $debug[$key] = $this->debug($value, $objects);
            } elseif ($value instanceof DataObject) {
                $debug[$key . ' (' . get_class($value) . ')'] = $value->debug(null, $objects);
            }
        }

        return $debug;
    }

    /**
     * Implementation of \ArrayAccess::offsetSet()
     *
     * @param string $offset
     * @param mixed $value
     * @return void
     * @link http://www.php.net/manual/en/arrayaccess.offsetset.php
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, mixed $value): void
    {
        $this->_data[$offset] = $value;
    }

    /**
     * Implementation of \ArrayAccess::offsetExists()
     *
     * @param string $offset
     * @return bool
     * @link http://www.php.net/manual/en/arrayaccess.offsetexists.php
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset): bool
    {
        return isset($this->_data[$offset]) || array_key_exists($offset, $this->_data);
    }

    /**
     * Implementation of \ArrayAccess::offsetUnset()
     *
     * @param string $offset
     * @return void
     * @link http://www.php.net/manual/en/arrayaccess.offsetunset.php
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset): void
    {
        unset($this->_data[$offset]);
    }

    /**
     * Implementation of \ArrayAccess::offsetGet()
     *
     * @param string $offset
     * @return mixed
     * @link http://www.php.net/manual/en/arrayaccess.offsetget.php
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset): mixed
    {
        if (isset($this->_data[$offset])) {
            return $this->_data[$offset];
        }

        return null;
    }
}

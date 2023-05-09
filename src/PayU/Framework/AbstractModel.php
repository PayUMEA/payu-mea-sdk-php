<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace PayU\Model;

use InvalidArgumentException;
use PayU\Auth\BasicAuth;
use PayU\Exception\ConfigurationException;
use PayU\Validation\JsonValidator;
use ReflectionException;
use stdClass;

/**
 * Class PayUModel
 *
 * Generic Model class that all API domain classes extend
 * Stores all member data in a Hash map that enables easy
 * JSON encoding/decoding
 *
 * @package PayU\Model
 */
class PayUModel
{
    /**
     * @var array properties hash map
     */
    private array $_propMap = [];

    /**
     * Default Constructor
     *
     * You can pass data as a json representation or array object. This argument eliminates the need
     * to do $obj->fromJson($data) later after creating the object.
     *
     * @param null $data
     * @throws InvalidArgumentException|ConfigurationException|ReflectionException
     */
    public function __construct($data = null)
    {
        switch (gettype($data)) {
            case "NULL":
                break;
            case "string":
                JsonValidator::validate($data);
                $this->fromJson($data);
                break;
            case "array":
                $this->fromArray($data);
                break;
            default:
        }
    }

    /**
     * Fills object value from Json string
     *
     * @param $json
     * @return $this
     * @throws ConfigurationException|ReflectionException
     */
    public function fromJson($json): static
    {
        return $this->fromArray(json_decode($json, true));
    }

    /**
     * Fills object value from Array list
     *
     * @param $arr
     * @return $this
     * @throws ConfigurationException|ReflectionException
     */
    public function fromArray($arr): static
    {
        if (!empty($arr)) {
            // Iterate over each element in array
            foreach ($arr as $k => $v) {
                // If the value is an array, it means, it is an object after conversion
                if (is_array($v)) {
                    // Determine the class of the object
                    if (($clazz = ReflectionHelper::getPropertyClass(get_class($this), $k)) != null) {
                        //$class = $clazz::getFullyQualifiedName();
                        // If the value is an associative array, it means, it's an object. Just make recursive call to it.
                        if (empty($v)) {
                            if (ReflectionHelper::isPropertyClassArray(get_class($this), $k)) {
                                // It means, it is an array of objects.
                                $this->assignValue($k, []);
                                continue;
                            }
                            $o = new $clazz();
                            $this->assignValue($k, $o);
                        } elseif (ArrayHelper::isAssocArray($v)) {
                            /** @var self $o */
                            $o = new $clazz();
                            $o->fromArray($v);
                            $this->assignValue($k, $o);
                        } else {
                            // Else, value is an array of object
                            $arr = [];
                            // Iterate through each element in that array.
                            foreach ($v as $nk => $nv) {
                                if (is_array($nv)) {
                                    $o = new $clazz();
                                    $o->fromArray($nv);
                                    $arr[$nk] = $o;
                                } else {
                                    $arr[$nk] = $nv;
                                }
                            }
                            $this->assignValue($k, $arr);
                        }
                    } else {
                        $this->assignValue($k, $v);
                    }
                } else {
                    $this->assignValue($k, $v);
                }
            }
        }

        return $this;
    }

    /**
     * Returns a list of Object from Array or Json String. It is generally used when your json
     * contains an array of this object
     *
     * @param mixed $data Array object or json string representation
     * @return PayUModel|array|null
     * @throws ConfigurationException|ReflectionException
     */
    public static function getList(mixed $data): PayUModel|array|null
    {
        // Return Null if Null
        if ($data === null) {
            return null;
        }

        if (is_a($data, get_class(new stdClass()))) {
            //This means, root element is object
            return new static(json_encode($data));
        }

        $list = [];

        if (is_array($data)) {
            $data = json_encode($data);
        }

        if (JsonValidator::validate($data)) {
            // It is valid JSON
            $decoded = json_decode($data);

            if ($decoded === null) {
                return $list;
            }

            if (is_array($decoded)) {
                foreach ($decoded as $v) {
                    $list[] = self::getList($v);
                }
            }

            if (is_a($decoded, get_class(new stdClass()))) {
                //This means, root element is object
                $list[] = new static(json_encode($decoded));
            }
        }

        return $list;
    }

    /**
     * Magic Method for toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJSON(128);
    }

    /**
     * Returns object JSON representation
     *
     * @param int $options http://php.net/manual/en/json.constants.php
     * @return string
     */
    public function toJSON(int $options = 0): string
    {
        return json_encode($this->toArray(), $options | 64);
    }

    /**
     * Returns array representation of object
     *
     * @return PayUModel|array
     */
    public function toArray(): PayUModel|array
    {
        foreach ($this as $key => $val) {
            if (is_object($val)) {
                $val->toArray();
            }

            $this->_propMap[$key] = $val;
        }

        return $this->_convertToArray($this->_propMap);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private function assignValue(string $key, mixed $value): void
    {
        $setter = 'set' . $this->convertToCamelCase($key);

        // If we find the setter, use that, otherwise use magic method.
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    /**
     * Converts the input key into a valid Setter Method Name
     *
     * @param string $key
     * @return string
     */
    private function convertToCamelCase(string $key): string
    {
        return str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $key)));
    }

    /**
     * Converts Params to Array
     *
     * @param $param
     * @return PayUModel|array
     */
    private function _convertToArray($param): PayUModel|array
    {
        $ret = [];

        foreach ($param as $k => $v) {
            if ($v instanceof PayUModel) {
                $ret[$k] = $v->toArray();
            } elseif (is_string($v) || is_numeric($v)) {
                $ret[$k] = $v;
            } elseif (is_array($v) && count($v) <= 0) {
                $ret[$k] = [];
            } elseif (is_array($v)) {
                $ret[$k] = $this->_convertToArray($v);
            } else {
                $ret[$k] = $v;
            }
        }

        // If the array is empty, which means an empty object,
        // we need to convert array to StdClass object to properly
        // represent JSON String
        if (count($ret) <= 0) {
            $ret = new PayUModel();
        }

        return $ret;
    }
}

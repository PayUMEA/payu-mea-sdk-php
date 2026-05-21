<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

use PayUSdk\Framework\Data\DataObject;

/**
 * Class AbstractModel
 *
 * Generic Model class that all API classes extends
 * Stores all member data in a Hash map that enables easy
 * JSON encoding/decoding and array traversal
 *
 * @package PayUSdk\Framework
 * @phpstan-consistent-constructor
 */
class AbstractModel extends DataObject
{
    /**
     * Constructor
     *
     * @param mixed $data
     */
    public function __construct(mixed $data = null)
    {
        if (is_array($data)) {
            parent::__construct([]);
            $this->fromArray($data);
        } elseif (is_object($data)) {
            $dataArr = ($data instanceof \PayUSdk\Framework\Data\DataObject) ? $data->toArray() : (array)$data;
            parent::__construct([]);
            $this->fromArray($dataArr);
        } elseif (is_string($data) && !empty($data)) {
            parent::__construct([]);
            $this->fromJson($data);
        } else {
            parent::__construct([]);
        }
    }
    /**
     * Magic getter for backwards compatibility with dynamic properties
     *
     * @param string $key
     * @return mixed
     */
    public function __get(string $key): mixed
    {
        return $this->getData($key);
    }

    /**
     * Magic setter for backwards compatibility with dynamic properties
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set(string $key, mixed $value): void
    {
        if ($value === null) {
            $this->unsetData($key);
        } else {
            $this->setData($key, $value);
        }
    }

    /**
     * Magic isset for backwards compatibility
     *
     * @param string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return $this->hasData($key);
    }

    /**
     * Magic unset for backwards compatibility
     *
     * @param string $key
     * @return void
     */
    public function __unset(string $key): void
    {
        $this->unsetData($key);
    }

    public function toJson(array $keys = []): bool|string
    {
        $arr = $this->toArray($keys);
        if (empty($arr)) {
            return '{}';
        }
        return json_encode($arr, 64);
    }

    /**
     * Convert model data to array.
     *
     * @param array<int, string> $keys
     * @return array<string, mixed>
     */
    public function toArray(array $keys = []): array
    {
        return parent::toArray($keys);
    }

    /**
     * Traverse array and convert AbstractModel instances, ensuring empty ones become stdClass.
     *
     * @param array<mixed, mixed> $data
     * @return array<mixed, mixed>
     */
    public function traverseArray(array $data = []): array
    {
        $array = [];
        foreach ($data as $key => $value) {
            if ($value instanceof AbstractModel) {
                $arr = $value->toArray();
                if (empty($arr)) {
                    $array[$key] = new \stdClass();
                } else {
                    $array[$key] = $value->traverseArray($arr);
                }
            } elseif ($value instanceof DataObject) {
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
     * Decode JSON string into object data recursively.
     *
     * @param string $json
     * @return $this
     */
    public function fromJson(string $json): static
    {
        $data = json_decode($json, true);
        if (is_array($data)) {
            $this->fromArray($data);
        }
        return $this;
    }

    /**
     * Fills object value from Array list with recursive object conversion
     *
     * @param array<string|int, mixed> $arr
     * @return $this
     */
    public function fromArray(array $arr): static
    {
        if (!empty($arr)) {
            foreach ($arr as $k => $v) {
                $valueToSet = $v;
                if (is_array($v)) {
                    $clazz = $this->getPropertyClass((string)$k);
                    if ($clazz !== null && class_exists($clazz)) {
                        if (empty($v)) {
                            if ($this->isPropertyClassArray((string)$k)) {
                                $valueToSet = [];
                            } else {
                                $valueToSet = new $clazz();
                            }
                        } elseif ($this->isAssocArray($v)) {
                            /** @var \PayUSdk\Framework\Data\DataObject $o */
                            $o = new $clazz();
                            if (method_exists($o, 'fromArray')) {
                                $o->fromArray($v);
                            } else {
                                $o->setData($v);
                            }
                            $valueToSet = $o;
                        } else {
                            $list = [];
                            foreach ($v as $nk => $nv) {
                                if (is_array($nv)) {
                                    /** @var \PayUSdk\Framework\Data\DataObject $o */
                                    $o = new $clazz();
                                    if (method_exists($o, 'fromArray')) {
                                        $o->fromArray($nv);
                                    } else {
                                        $o->setData($nv);
                                    }
                                    $list[$nk] = $o;
                                } else {
                                    $list[$nk] = $nv;
                                }
                            }
                            $valueToSet = $list;
                        }
                    }
                }

                // Check if a setter exists for the CamelCase version of the key
                $camelKey = str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', (string)$k)));
                $setter = 'set' . $camelKey;
                if (!method_exists($this, $setter) && method_exists($this, $setter . 's')) {
                    $setter = $setter . 's';
                }

                if (method_exists($this, $setter)) {
                    $canCallSetter = true;
                    try {
                        $refMethod = new \ReflectionMethod($this, $setter);
                        $params = $refMethod->getParameters();
                        if (count($params) > 0) {
                            $paramType = $params[0]->getType();
                            if ($paramType instanceof \ReflectionNamedType) {
                                $typeName = $paramType->getName();
                                if ($typeName === 'float') {
                                    if (is_numeric($valueToSet)) {
                                        $valueToSet = (float)$valueToSet;
                                    } else {
                                        $canCallSetter = false;
                                    }
                                } elseif ($typeName === 'int') {
                                    if (is_numeric($valueToSet)) {
                                        $valueToSet = (int)$valueToSet;
                                    } else {
                                        $canCallSetter = false;
                                    }
                                } elseif ($typeName === 'bool') {
                                    if (is_bool($valueToSet) || $valueToSet === 'true' || $valueToSet === 'false' || $valueToSet === '1' || $valueToSet === '0' || $valueToSet === 1 || $valueToSet === 0) {
                                        $valueToSet = filter_var($valueToSet, FILTER_VALIDATE_BOOLEAN);
                                    } else {
                                        $canCallSetter = false;
                                    }
                                } elseif ($typeName === 'array') {
                                    if (!is_array($valueToSet)) {
                                        $valueToSet = [$valueToSet];
                                    }
                                } elseif (class_exists($typeName) || interface_exists($typeName)) {
                                    if (!($valueToSet instanceof $typeName)) {
                                        $canCallSetter = false;
                                    }
                                }
                            }
                        }
                    } catch (\Throwable $e) {
                    }
                    if ($canCallSetter) {
                        $this->$setter($valueToSet);
                    } else {
                        $this->setData((string)$k, $valueToSet);
                    }
                } else {
                    $this->setData((string)$k, $valueToSet);
                }
            }
        }
        return $this;
    }

    /**
     * Retrieves the class name of the property from the getter method's doc comment.
     *
     * @param string $propertyName
     * @return string|null
     */
    protected function getPropertyClass(string $propertyName): ?string
    {
        $class = get_class($this);
        $getter = 'get' . ucfirst($propertyName);
        if (!method_exists($class, $getter)) {
            $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $propertyName)));
            if (!method_exists($class, $getter)) {
                return null;
            }
        }

        try {
            $refMethod = new \ReflectionMethod($class, $getter);
            $doc = $refMethod->getDocComment();
            if ($doc && preg_match('/@return\s+([^\s]+)/', $doc, $matches)) {
                $typeRaw = $matches[1];
                if (str_ends_with($typeRaw, '[]')) {
                    $typeRaw = substr($typeRaw, 0, -2);
                }

                // Parse union types (e.g. Total|null) and strip nullable ? prefix
                $types = explode('|', $typeRaw);
                $type = null;
                foreach ($types as $t) {
                    if (str_starts_with($t, '?')) {
                        $t = substr($t, 1);
                    }
                    if (strtolower($t) !== 'null' && strtolower($t) !== 'void') {
                        $type = $t;
                        break;
                    }
                }

                if ($type === null) {
                    return null;
                }

                if (in_array(strtolower($type), ['string', 'int', 'bool', 'float', 'array', 'mixed'])) {
                    return null;
                }

                // Handle interfaces by stripping 'Interface' and using the corresponding PayUSdk\Model class
                if (str_ends_with($type, 'Interface')) {
                    $concreteType = substr($type, 0, -9);
                    $sdkModel = 'PayUSdk\\Model\\' . $concreteType;
                    if (class_exists($sdkModel)) {
                        return $sdkModel;
                    }
                }

                if (str_starts_with($type, '\\')) {
                    return $type;
                }

                $refClass = new \ReflectionClass($class);
                $namespace = $refClass->getNamespaceName();

                $namespacedClass = $namespace . '\\' . $type;
                if (class_exists($namespacedClass)) {
                    return $namespacedClass;
                }

                if (class_exists($type)) {
                    return $type;
                }

                if (str_contains($namespace, 'PayU\\Test\\Model')) {
                    $mapped = 'PayU\\Test\\Model\\' . $type;
                    if (class_exists($mapped)) {
                        return $mapped;
                    }
                }

                $sdkModel = 'PayUSdk\\Model\\' . $type;
                if (class_exists($sdkModel)) {
                    return $sdkModel;
                }

                $sdkFramework = 'PayUSdk\\Framework\\' . $type;
                if (class_exists($sdkFramework)) {
                    return $sdkFramework;
                }
            }
        } catch (\Throwable $e) {
        }

        return null;
    }

    /**
     * Checks if the property class is defined as an array type.
     *
     * @param string $propertyName
     * @return bool
     */
    protected function isPropertyClassArray(string $propertyName): bool
    {
        $class = get_class($this);
        $getter = 'get' . ucfirst($propertyName);
        if (!method_exists($class, $getter)) {
            $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $propertyName)));
            if (!method_exists($class, $getter)) {
                return false;
            }
        }

        try {
            $refMethod = new \ReflectionMethod($class, $getter);
            $doc = $refMethod->getDocComment();
            if ($doc && preg_match('/@return\s+([^\s]+)/', $doc, $matches)) {
                $type = $matches[1];
                return str_contains($type, '[]') || str_contains(strtolower($doc), 'array of');
            }
        } catch (\Throwable $e) {
        }
        return false;
    }

    /**
     * Check if array is associative.
     *
     * @param array<string|int, mixed> $arr
     * @return bool
     */
    protected function isAssocArray(array $arr): bool
    {
        if ([] === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * Get object data with key variations (camelCase, snake_case) fallback.
     *
     * @param string $key
     * @param int|string|null $index
     * @return mixed
     */
    public function getData(string $key = '', int|string|null $index = null): mixed
    {
        if ($key === '') {
            return parent::getData($key, $index);
        }

        if (parent::hasData($key)) {
            return parent::getData($key, $index);
        }

        // Try camelCase version: e.g. "expire_month" -> "expireMonth"
        $camelKey = lcfirst(str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $key))));
        if (parent::hasData($camelKey)) {
            return parent::getData($camelKey, $index);
        }

        // Try snake_case version: e.g. "expireMonth" -> "expire_month"
        $snakeKey = strtolower(trim((string)preg_replace('/([A-Z]|[0-9]+)/', "_$1", $key), '_'));
        $snakeKey2 = str_replace('_3_d', '_3d', $snakeKey);
        if (parent::hasData($snakeKey)) {
            return parent::getData($snakeKey, $index);
        }
        if (parent::hasData($snakeKey2)) {
            return parent::getData($snakeKey2, $index);
        }

        // Try normalized match: lowercase and no underscores/dashes
        $normalizedTarget = strtolower(str_replace(['_', '-'], '', $key));
        foreach (array_keys($this->_data) as $k) {
            if (strtolower(str_replace(['_', '-'], '', (string)$k)) === $normalizedTarget) {
                return parent::getData((string)$k, $index);
            }
        }

        return parent::getData($key, $index);
    }

    /**
     * Check if data exists with key variations (camelCase, snake_case) fallback.
     *
     * @param string $key
     * @return bool
     */
    public function hasData(string $key = ''): bool
    {
        if (empty($key)) {
            return parent::hasData($key);
        }

        if (parent::hasData($key)) {
            return true;
        }

        $camelKey = lcfirst(str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $key))));
        if (parent::hasData($camelKey)) {
            return true;
        }

        $snakeKey = strtolower(trim((string)preg_replace('/([A-Z]|[0-9]+)/', "_$1", $key), '_'));
        $snakeKey2 = str_replace('_3_d', '_3d', $snakeKey);
        if (parent::hasData($snakeKey) || parent::hasData($snakeKey2)) {
            return true;
        }

        // Try normalized match: lowercase and no underscores/dashes
        $normalizedTarget = strtolower(str_replace(['_', '-'], '', $key));
        foreach (array_keys($this->_data) as $k) {
            if (strtolower(str_replace(['_', '-'], '', (string)$k)) === $normalizedTarget) {
                return true;
            }
        }

        return false;
    }
}

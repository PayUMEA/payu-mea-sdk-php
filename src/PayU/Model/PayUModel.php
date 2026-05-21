<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;

/**
 * Class PayUModel
 *
 * @package PayUSdk\Model
 */
abstract class PayUModel extends AbstractModel
{
    /**
     * Constructor
     *
     * @param mixed $data
     */
    public function __construct(mixed $data = null)
    {
        if (is_array($data)) {
            parent::__construct($data);
            $this->fromArray($data);
        } elseif (is_object($data)) {
            $dataArr = ($data instanceof \PayUSdk\Framework\Data\DataObject) ? $data->toArray() : (array)$data;
            parent::__construct($dataArr);
            $this->fromArray($dataArr);
        } elseif (is_string($data) && !empty($data)) {
            parent::__construct([]);
            $this->fromJson($data);
        } else {
            parent::__construct([]);
        }
    }

    public static function getList(mixed $input): ?array
    {
        if ($input === null) {
            return null;
        }

        if ($input === '') {
            return [];
        }

        if (is_object($input)) {
            return [new static($input)];
        }

        if ($input instanceof static) {
            return [$input];
        }

        $list = [];

        if (is_array($input)) {
            if (!empty($input) && array_keys($input) !== range(0, count($input) - 1)) {
                return [new static($input)];
            }
            $input = json_encode($input);
        }

        if (is_string($input)) {
            \PayUSdk\Framework\Validation\JsonValidator::validate($input);
            $decoded = json_decode($input);
            if ($decoded === null) {
                return $list;
            }
            if (is_array($decoded)) {
                foreach ($decoded as $v) {
                    $resolved = static::getList($v);
                    if (is_array($resolved) && count($resolved) === 1 && $resolved[0] instanceof static) {
                        $list[] = $resolved[0];
                    } else {
                        $list[] = $resolved;
                    }
                }
            } elseif (is_a($decoded, \stdClass::class)) {
                $list[] = new static(json_encode($decoded));
            }
        }

        return $list;
    }

    public function fromJson(string $json): static
    {
        \PayUSdk\Framework\Validation\JsonValidator::validate($json);
        parent::fromJson($json);
        return $this;
    }
}

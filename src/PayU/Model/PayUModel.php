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
     * @param array $data
     */
    final public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Get list of objects from JSON or array
     *
     * @param mixed $input
     * @return array|null
     */
    public static function getList(mixed $input): ?array
    {
        if ($input === null || $input === '') {
            return [];
        }

        if (is_string($input)) {
            $input = json_decode($input, true);
        }

        if (!is_array($input)) {
            return null;
        }

        $list = [];
        foreach ($input as $item) {
            if (is_array($item)) {
                $list[] = new static($item);
            } else {
                $list[] = $item;
            }
        }

        return $list;
    }

    /**
     * Decode JSON string into object data
     *
     * @param string $json
     * @return $this
     */
    public function fromJson(string $json): static
    {
        $this->setData(json_decode($json, true));
        return $this;
    }
}

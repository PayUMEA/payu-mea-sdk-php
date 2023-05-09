<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework;

use PayU\Framework\Data\DataObject;

/**
 * Class AbstractModel
 *
 * Generic Model class that all API classes extends
 * Stores all member data in a Hash map that enables easy
 * JSON encoding/decoding and array traversal
 *
 * @package PayU\Framework
 */
class AbstractModel extends DataObject
{
}

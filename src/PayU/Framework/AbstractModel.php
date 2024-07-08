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
 */
class AbstractModel extends DataObject
{
}

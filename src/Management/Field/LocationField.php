<?php

/**
 * This file is part of the contentful-management.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Management\Field;

/**
 * LocationField class.
 */
class LocationField extends AbstractField
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return 'Location';
    }
}

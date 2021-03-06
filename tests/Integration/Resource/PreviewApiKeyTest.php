<?php

/**
 * This file is part of the contentful-management.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\Unit\Resource;

use Contentful\Management\Resource\PreviewApiKey;
use PHPUnit\Framework\TestCase;

class PreviewApiKeyTest extends TestCase
{
    /**
     * @expectedException \LogicException
     */
    public function testInvalidCreation()
    {
        new PreviewApiKey();
    }
}

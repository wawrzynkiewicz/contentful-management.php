<?php

/**
 * This file is part of the contentful-management.php package.
 *
 * @copyright 2015-2017 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Management\Mapper;

use Contentful\Management\Resource\Asset as ResourceClass;
use Contentful\File\File;
use Contentful\File\FileInterface;
use Contentful\File\ImageFile;
use Contentful\File\LocalUploadFile;
use Contentful\File\RemoteUploadFile;
use Contentful\Management\SystemProperties;
use Contentful\Link;

/**
 * Asset class.
 */
class Asset extends BaseMapper
{
    /**
     * {@inheritdoc}
     */
    public function map($resource, array $data): ResourceClass
    {
        $fields = $data['fields'];

        return $this->hydrate($resource ?? ResourceClass::class, [
            'sys' => new SystemProperties($data['sys']),
            'title' => $fields['title'] ?? null,
            'description' => $fields['description'] ?? null,
            'file' => isset($fields['file']) ? array_map([$this, 'buildFile'], $fields['file']) : null,
        ]);
    }

    /**
     * @param array $data
     *
     * @return FileInterface
     */
    protected function buildFile(array $data): FileInterface
    {
        if (isset($data['uploadFrom'])) {
            return new LocalUploadFile(
                $data['fileName'],
                $data['contentType'],
                new Link(
                    $data['uploadFrom']['sys']['id'],
                    $data['uploadFrom']['sys']['linkType']
                )
            );
        }

        if (isset($data['upload'])) {
            return new RemoteUploadFile(
                $data['fileName'],
                $data['contentType'],
                $data['upload']
            );
        }

        $details = $data['details'];
        if (isset($details['image'])) {
            return new ImageFile(
                $data['fileName'],
                $data['contentType'],
                $data['url'],
                $details['size'],
                $details['image']['width'],
                $details['image']['height']
            );
        }

        return new File(
            $data['fileName'],
            $data['contentType'],
            $data['url'],
            $details['size']
        );
    }
}

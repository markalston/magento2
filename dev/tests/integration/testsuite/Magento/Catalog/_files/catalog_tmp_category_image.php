<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

use Magento\Framework\App\Filesystem\DirectoryList;

$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

/** @var $mediaDirectory \Magento\Framework\Filesystem\Directory\WriteInterface */
$mediaDirectory = $objectManager->get(\Magento\Framework\Filesystem::class)
    ->getDirectoryWrite(DirectoryList::MEDIA);
$imageUploader = $objectManager->create(
    \Magento\Catalog\Model\ImageUploader::class,
    [
        'baseTmpPath' => $mediaDirectory->getRelativePath('catalog/tmp/category'),
        'basePath' => $mediaDirectory->getRelativePath('catalog/category'),
        'allowedExtensions' => ['jpg', 'jpeg', 'gif', 'png'],
        'allowedMimeTypes' => ['image/jpg', 'image/jpeg', 'image/gif', 'image/png']
    ]
);
$fileName = 'magento_small_image.jpg';
$tmpFilePath = $imageUploader->getBaseTmpPath() . DIRECTORY_SEPARATOR. $fileName;
$mediaDirectory->create($imageUploader->getBaseTmpPath());

copy(__DIR__ . DIRECTORY_SEPARATOR . $fileName, $mediaDirectory->getAbsolutePath($tmpFilePath));

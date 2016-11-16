<?php

namespace Application\Sonata\MediaBundle\Provider;

use Sonata\MediaBundle\Provider\ImageProvider as BaseImageProvider;
use Sonata\MediaBundle\Model\MediaInterface;

class ImageProvider extends BaseImageProvider
{
    public function postPersist(MediaInterface $media)
    {
        if ($media->getBinaryContent() === null) {
            return;
        }

        $this->setFileContents($media);

        //$this->generateThumbnails($media);
    }

    /**
     * {@inheritdoc}
     */
    public function postUpdate(MediaInterface $media)
    {
        if (!$media->getBinaryContent() instanceof \SplFileInfo) {
            return;
        }

        // Delete the current file from the FS
        $oldMedia = clone $media;

        // if no previous reference is provided, it prevents
        // Filesystem from trying to remove a directory
        if ($media->getPreviousProviderReference() !== null) {
            $oldMedia->setProviderReference($media->getPreviousProviderReference());

            $path = $this->getReferenceImage($oldMedia);

            if ($this->getFilesystem()->has($path)) {
                $this->getFilesystem()->delete($path);
            }
        }

        $this->fixBinaryContent($media);

        $this->setFileContents($media);

        //$this->generateThumbnails($media);
    }

}

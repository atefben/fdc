<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

/**
 * Class MediaAvailableExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class MediaVideoExtension extends Twig_Extension
{
    private $localeFallback;

    private $requestStack;

    public function __construct($localeFallback, $requestStack)
    {
        $this->localeFallback = $localeFallback;
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('is_available_video', array($this, 'isAvailableVideo')),
            new Twig_SimpleFunction('get_available_video', array($this, 'getAvailableVideo')),
            new Twig_SimpleFunction('get_available_webtv_image_file', array($this, 'getAvailableWebTvImageFile')),
        );
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('is_available_video', array($this, 'isAvailableVideo')),
            new Twig_SimpleFilter('get_available_video', array($this, 'getAvailableVideo')),
            new Twig_SimpleFilter('get_available_webtv_image_file', array($this, 'getAvailableWebTvImageFile')),
        );
    }

    /**
     * @param $video
     * @param bool $force
     * @param null $locale
     * @return bool
     */
    public function isAvailableVideo($video, $force = false, $locale = null)
    {
        if ($locale === null) {
            $locale = $this->localeFallback;
        }
        if ($video instanceof MediaVideo) {
            $trans = $video->findTranslationByLocale($locale);
            $fr = $video->findTranslationByLocale('fr');

            if (!$fr || $fr->getStatus() !== MediaVideoTranslation::STATUS_PUBLISHED) {
                return false;
            }

            if ($fr && !$force) {
                $status = $fr->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                $encoded = $fr->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                $hasURL = $fr->getWebmUrl() && $fr->getMp4Url();
                if ($status && $encoded && $hasURL) {
                    return true;
                }
            }

            if ($trans) {
                if ($locale == 'fr') {
                    $status = $trans->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                } else {
                    $status = $trans->getStatus() === MediaVideoTranslation::STATUS_TRANSLATED;
                }
                $encoded = $trans->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                $hasURL = $trans->getWebmUrl() && $trans->getMp4Url();
                if ($status && $encoded && $hasURL) {
                    return true;
                }
            }

        }
    }

    /**
     * @param $video
     * @param bool $force
     * @param null $locale
     */
    public function getAvailableVideo($video, $force = false, $locale = null)
    {
        if ($locale === null) {
            $locale = $this->localeFallback;
        }
        if ($video instanceof MediaVideo) {
            $trans = $video->findTranslationByLocale($locale);
            $fr = $video->findTranslationByLocale('fr');
            if ($trans instanceof MediaVideoTranslation || $fr instanceof MediaVideoTranslation) {
                if ($trans) {
                    if ($locale == 'fr') {
                        $status = $trans->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                    } else {
                        $status = $trans->getStatus() === MediaVideoTranslation::STATUS_TRANSLATED;
                    }

                    $encoded = $trans->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                    $hasURL = $trans->getWebmUrl() && $trans->getMp4Url();
                    if ($status && $encoded && $hasURL) {
                        return $trans;
                    }
                }

                if ($fr and !$force) {
                    $status = $fr->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                    $encoded = $fr->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                    $hasURL = $fr->getWebmUrl() && $fr->getMp4Url();
                    if ($status && $encoded && $hasURL) {
                        return $fr;
                    }
                }
            }
        }
    }

    public function getAvailableWebTvImageFile($mediaImage, $fallback = true)
    {
        if ($mediaImage instanceof MediaImage) {
            $locale = $this->requestStack->getCurrentRequest()->getLocale();
            $now = new \DateTime();
            $fr = $trans = $mediaImage->findTranslationByLocale('fr');
            $isPublished = $fr->getStatus() === TranslateChildInterface::STATUS_PUBLISHED;
            $isPublished = $isPublished && $mediaImage->getPublishedAt() <= $now;
            $isPublished = $isPublished && ($mediaImage->getPublishEndedAt() === null || $mediaImage->getPublishEndedAt() >= $now);
            if ($isPublished) {
                $trans = $mediaImage->findTranslationByLocale($locale);
                if ($trans instanceof MediaImageTranslation && $trans->getFile() && $locale == 'fr') {
                    return $trans->getFile();
                } elseif ($trans instanceof MediaImageTranslation && $trans->getFile() && $trans->getStatus() === TranslateChildInterface::STATUS_TRANSLATED) {
                    return $trans->getFile();
                }
                if ($fallback && 'fr' !== $locale) {
                    $master = $mediaImage->findTranslationByLocale('fr');
                    return $master->getFile();
                }
            }
        }
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'media_video_extension';
    }
}
<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

/**
 * Class MediaAvailableExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class MediaVideoExtension extends Twig_Extension
{


    /**
     * @var string
     */
    private $localeFallback;

    /**
     * FilmMediaExtension constructor.
     * @param string $localeFallback
     s*/
    public function __construct($localeFallback)
    {
        $this->localeFallback = $localeFallback;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('is_available_video', array($this, 'isAvailableVideo')),
            new Twig_SimpleFunction('get_available_video', array($this, 'getAvailableVideo')),
        );
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('is_available_video', array($this, 'isAvailableVideo')),
            new Twig_SimpleFilter('get_available_video', array($this, 'getAvailableVideo')),
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
                $encoded = $fr->getJobWebmState() == MediaVideoTranslation::ENCODING_STATE_READY;
                $encoded = $encoded  && $fr->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                $hasURL = $fr->getWebmUrl() && $fr->getMp4Url();
                if ($status && $encoded && $hasURL) {
                    return true;
                }
            }

            if ($trans) {
                if ($locale == 'fr') {
                    $status = $trans->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                }
                else {
                    $status = $trans->getStatus() === MediaVideoTranslation::STATUS_TRANSLATED;
                }
                $encoded = $trans->getJobWebmState() == MediaVideoTranslation::ENCODING_STATE_READY;
                $encoded = $encoded  && $trans->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
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
        error_log($locale);
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
                    }
                    else {
                        $status = $trans->getStatus() === MediaVideoTranslation::STATUS_TRANSLATED;
                    }
                    //$encoded = $trans->getJobWebmState() == MediaVideoTranslation::ENCODING_STATE_READY;
                    $encoded = $trans->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                    $hasURL = $trans->getWebmUrl() && $trans->getMp4Url();
                    if ($status && $encoded && $hasURL) {
                        return $trans;
                    }
                    error_log('OK');
                }

                if ($fr and !$force) {
                    $status = $fr->getStatus() === MediaVideoTranslation::STATUS_PUBLISHED;
                    $encoded = $fr->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY;
                    $hasURL = $fr->getWebmUrl() && $fr->getMp4Url();
                    if ($status && $encoded && $hasURL) {
                        return $fr;
                        error_log('NOK');
                    }
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
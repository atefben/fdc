<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Behat\Transliterator\Transliterator;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_Extension;

/**
 * Class MiscExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class MiscExtension extends Twig_Extension
{

    /**
     * @var string
     */
    protected $defaultLocale;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @param string $defaultLocale
     */
    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @param RequestStack $requestStack
     */
    public function setRequestStack(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('urlize', [$this, 'urlize']),
            new \Twig_SimpleFilter('is_published', [$this, 'isPublished']),
        ];
    }

    public function urlize($text)
    {
        return Transliterator::urlize($text);
    }

    public function isPublished($object, $site = null)
    {
        if (!$object || !method_exists($object, 'findTranslationByLocale')) {
            return null;
        }

        return $this->isPublishedStatus($object) &&
            $this->isPublishedDate($object) &&
            $this->isPublishedInSite($object, $site) &&
            $this->isPublishedMediaVideo($object) &&
            $this->isPublishedMediaAudio($object);
    }

    private function isPublishedInSite($object, $site)
    {
        if (!method_exists($object, 'getSites') || !$site) {
            return true;
        }
        $inSite = false;
        if ($site) {
            foreach ($object->getSites() as $site) {
                if ($site->getSlug() == $site) {
                    $inSite = true;
                }
            }
        }
        return $inSite;
    }

    private function isPublishedDate($object)
    {
        if (!method_exists($object, 'getPublishedAt') || !method_exists($object, 'getPublishEndedAt')) {
            return true;
        }
        $now = time();
        return $object->getPublishedAt() &&
            $object->getPublishedAt()->getTimestamp() <= $now
            && (!$object->getPublishEndedAt() || $object->getPublishEndedAt()->getTimestamp() >= $now);
    }

    private function isPublishedMediaVideo($object)
    {
        if ($object instanceof MediaVideo) {
            $currentLocale = $this->requestStack->getCurrentRequest()->getLocale();
            $trans = $object->findTranslationByLocale($currentLocale);
            if (
                $trans instanceof MediaVideoTranslation &&
                $trans->getJobWebmState() == MediaVideoTranslation::ENCODING_STATE_READY &&
                $trans->getJobMp4State() == MediaVideoTranslation::ENCODING_STATE_READY
            ) {
                return true;
            }
            return false;
        }
        return true;
    }

    private function isPublishedMediaAudio($object)
    {
        if ($object instanceof MediaAudio) {
            $currentLocale = $this->requestStack->getCurrentRequest()->getLocale();
            $trans = $object->findTranslationByLocale($currentLocale);
            if (
                $trans instanceof MediaAudioTranslation &&
                $trans->getJobMp3State() == MediaAudioTranslation::ENCODING_STATE_READY
            ) {
                return true;
            }
            return false;
        }
        return true;
    }

    private function isPublishedStatus($object)
    {
        $currentLocale = $this->requestStack->getCurrentRequest()->getLocale();
        $trans = $object->findTranslationByLocale($currentLocale);
        if (!$trans) {
            return false;
        }
        if ($this->defaultLocale == $currentLocale) {
            if ($trans->getStatus() == TranslateChildInterface::STATUS_PUBLISHED) {
                return true;
            }
            return false;
        } else {
            $main = $object->findTranslationByLocale($this->defaultLocale);
            if ($main->getStatus() == TranslateChildInterface::STATUS_PUBLISHED
                && $trans->getStatus() == TranslateChildInterface::STATUS_TRANSLATED
            ) {
                return true;
            }
            return false;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'misc_extension';
    }
}
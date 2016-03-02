<?php

namespace Base\ApiBundle\Component;

use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\MediaAudioTranslation;

use FOS\RestBundle\Controller\FOSRestController as BaseFOSRestController;

class FOSRestController extends BaseFOSRestController
{
    public function removeUnpublishedNewsAudioVideo($array, $locale, $count = null)
    {
        $newsTypes = array('NewsAudio', 'NewsVideo');

        foreach ($newsTypes as $newsType) {
            foreach ($array as $key => $news) {
                if (strpos(get_class($news), $newsType) !== false) {
                    $trans = $news->getAudio()->findTranslationByLocale($locale);
                    $transFr = $news->getAudio()->findTranslationByLocale('fr');
                    if ($this->checkMediaAudioVideoPublished($trans, $transFr) === false) {
                        if ($this->checkMediaAudioVideoPublished($transFr, $transFr) === false) {
                            unset($array[$key]);
                        }
                    }
                }
            }
        }

        $array = array_values($array);

        if ($count !== null) {
            $array = array_slice($array, 0, $count);
        }

        return $array;
    }

    private function checkMediaAudioVideoPublished($trans, $transFr)
    {
        if ($trans === null || $transFr->getStatus() !== MediaAudioTranslation::STATUS_PUBLISHED) {
            return false;
        }

        if (strpos(get_class($trans), 'MediaAudioTranslation')) {
            if ($trans->getFile() === null ||
                $trans->getJobMp3State() != MediaAudioTranslation::ENCODING_STATE_READY ||
                $trans->getMp3Url() === null) {
                return false;
            }
        }

        if (strpos(get_class($trans), 'MediaVideoTranslation')) {
            if ($trans->getFile() === null  ||
                $trans->getJobMp4State() != MediaVideoTranslation::ENCODING_STATE_READY ||
                $trans->getJobWebmState() != MediaVideoTranslation::ENCODING_STATE_READY ||
                $trans->getMp4Url() === null || $trans->getWebmUrl() === null) {
                return false;
            }
        }

        return true;
    }
}
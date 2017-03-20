<?php

namespace FDC\CourtMetrageBundle\Controller;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;

class CcmController extends BaseController
{
    public function createDateRangeArrayEvent($strDateFrom, $strDateTo, $reverse = true)
    {
        $aryRange = array();
        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));
        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom));
            while ($iDateFrom < $iDateTo) {
                $iDateFrom += 86400;
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }

        if ($reverse == true) {
            return array_reverse($aryRange);
        } else {
            return ($aryRange);
        }

    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }

    public function removeUnpublishedNewsAudioVideo($array, $locale, $count = null, $hideDisplayedHome = false)
    {
        $newsTypes = array('NewsAudio', 'NewsVideo', 'InfoAudio', 'StatementAudio', 'InfoVideo', 'StatementVideo');

        $mediaTypes = array(
            'NewsAudio'      => 'getAudio',
            'NewsVideo'      => 'getVideo',
            'InfoAudio'      => 'getAudio',
            'StatementAudio' => 'getAudio',
            'InfoVideo'      => 'getVideo',
            'StatementVideo' => 'getVideo',
        );

        foreach ($newsTypes as $newsType) {
            foreach ($array as $key => $news) {
                if (strpos(get_class($news), $newsType) !== false) {
                    if ($news->{$mediaTypes[$newsType]}() == null) {
                        unset($array[$key]);
                    } elseif ($hideDisplayedHome && $news->{$mediaTypes[$newsType]}()->getDisplayedHome()) {
                        unset($array[$key]);
                    } else {
                        $trans = $news->{$mediaTypes[$newsType]}()->findTranslationByLocale($locale);
                        $transFr = $news->{$mediaTypes[$newsType]}()->findTranslationByLocale('fr');
                        if ($this->checkMediaAudioVideoPublished($trans, $transFr) === false) {
                            if ($this->checkMediaAudioVideoPublished($transFr, $transFr) === false) {
                                unset($array[$key]);
                            }
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
            if ($trans->getJobMp3State() != MediaAudioTranslation::ENCODING_STATE_READY ||
                $trans->getMp3Url() === null
            ) {
                return false;
            }
        }

        if (strpos(get_class($trans), 'MediaVideoTranslation')) {
            if ($trans->getJobMp4State() != MediaVideoTranslation::ENCODING_STATE_READY ||
                $trans->getMp4Url() === null || $trans->getWebmUrl() === null
            ) {
                return false;
            }
        }

        return true;
    }


    /**
     * @param $route
     */
    public function isPageEnabled($route)
    {
        $page = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCEventRoutes')->findOneBy(array(
                                                                                                           'route' => $route,
                                                                                                       ))
        ;

        if ($page && !$page->getEnabled()) {
            throw $this->createNotFoundException("This page is disabled.");
        }

    }

    /**
     * @return Settings
     * @throws NotFoundHttpException
     */
    public function getSettings()
    {
        $settings = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');

        if ($settings === null) {
            throw $this->createNotFoundException();
        }
        return $settings;
    }

    /**
     * @param $name
     * @param $arguments
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function __call($name, $arguments)
    {
        if (substr($name, 0, 11) === 'getBaseCore' && substr($name, -10) === 'Repository') {
            return $this->getDoctrineManager()->getRepository('BaseCoreBundle:' . str_replace(['getBaseCore', 'Repository'], '', $name));
        }
        throw $this->createNotFoundException("The methods $name does not exist.");
    }

    /**
     * @param null $year
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival($year = null)
    {

        if (is_null($year)) {
            if (!$this->getSettings() || $this->getSettings()->getFestival() === null) {
                throw $this->createNotFoundException();
            }

            return $this->getSettings()->getFestival();
        } else {
            $festival = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($year);
            if (!$festival) {
                throw $this->createNotFoundException();
            } else {
                return $festival;
            }
        }

    }

    public function isWaitingPage(Request $request, $routeId = null)
    {
        $route = ($routeId !== null) ? $routeId : $request->get('_route');
        // check if waiting page is enabled
        $waitingPage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWaiting')
            ->getSingleWaitingPageByRoute($route)
        ;

        if ($waitingPage) {
            $debug = debug_backtrace();
            if (isset($debug[1]) && isset($debug[1]['class']) && strpos($debug[1]['class'], 'Mobile')) {
                return $this->render('FDCEventMobileBundle:Global:waiting-page.html.twig', array(
                    'waitingPage' => $waitingPage,
                ));
            } else {
                return $this->render('FDCEventBundle:Global:waiting-page.html.twig', array(
                    'waitingPage' => $waitingPage,
                ));
            }
        }
    }

    public function throwNotFoundExceptionOnNullObject($object, $message = '')
    {
        if (!$object) {
            throw $this->createNotFoundException($message);
        }
    }

    public function getEventSite()
    {
        static $site = null;
        if (!$site) {
            $site = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Site')->findOneBy(['slug' => 'site-evenementiel']);
        }
        return $site;
    }

    public function getPressSite()
    {
        static $site = null;
        if (!$site) {
            $site = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Site')->findOneBy(['slug' => 'site-press']);
        }
        return $site;
    }

    protected function getTranslation($object, $locale = 'fr')
    {
        if (method_exists($object, 'findTranslationByLocale')) {
            $trans = $object->findTranslationByLocale($locale);
            if ($trans) {
                return $trans;
            }
        }
    }
}

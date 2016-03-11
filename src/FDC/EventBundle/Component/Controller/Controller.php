<?php

namespace FDC\EventBundle\Component\Controller;

use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;

use Base\CoreBundle\Entity\Settings;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{

    /**
     * @return ObjectManager
     */
    public function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }

    public function removeUnpublishedNewsAudioVideo($array, $locale, $count = null)
    {
        $newsTypes = array('NewsAudio', 'NewsVideo', 'InfoAudio', 'StatementAudio', 'InfoVideo', 'StatementVideo');

        $mediaTypes = array(
            'NewsAudio'      => 'getAudio',
            'NewsVideo'      => 'getVideo',
            'InfoAudio'      => 'getAudio',
            'StatementAudio' => 'getAudio',
            'InfoVideo'      => 'getVideo',
            'StatementVideo' => 'getVideo'
        );

        foreach ($newsTypes as $newsType) {
            foreach ($array as $key => $news) {
                if (strpos(get_class($news), $newsType) !== false) {
                    if ($news->{$mediaTypes[$newsType]}() == null) {
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
            if ($trans->getFile() === null ||
                $trans->getJobMp3State() != MediaAudioTranslation::ENCODING_STATE_READY ||
                $trans->getMp3Url() === null
            ) {
                return false;
            }
        }

        if (strpos(get_class($trans), 'MediaVideoTranslation')) {
            if ($trans->getFile() === null ||
                $trans->getJobMp4State() != MediaVideoTranslation::ENCODING_STATE_READY ||
                $trans->getJobWebmState() != MediaVideoTranslation::ENCODING_STATE_READY ||
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
            'route' => $route
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
     * @return Settings
     * @throws NotFoundHttpException
     */
    public function getFestival()
    {

        if (!$this->getSettings() || $this->getSettings()->getFestival() === null) {
            throw $this->createNotFoundException();
        }

        return $this->getSettings()->getFestival();
    }

    public function isWaitingPage(Request $request)
    {
        // check if waiting page is enabled
        $waitingPage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageWaiting')
            ->getSingleWaitingPageByRoute($request->get('_route'))
        ;

        if ($waitingPage) {
            $waitingPage->getBanner()->findTranslationByLocale('fr')->getFile()->getContext();
            return $this->render('FDCEventBundle:Global:waiting-page.html.twig', array(
                'waitingPage' => $waitingPage
            ));
        }
    }

}
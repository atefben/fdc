<?php

namespace Base\AdminBundle\Controller;

use \DateTime;

use JMS\SecurityExtraBundle\Annotation\Secure;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * LockController class.
 *
 * \@extends Controller
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 *
 * @Route("/lock")
 */
class LockController extends Controller
{

    private static $entityMapper = array(
        // General
        'homepage'                         => 'Homepage',
        'fdcpagewebtvlive'                 => 'FDCPageWebTvLive',
        'tag'                              => 'Tag',
        'webtv'                            => 'WebTv',
        'contacttheme'                     => 'ContactTheme',
        'theme'                            => 'Theme',
        'fdcpagewaiting'                   => 'FDCPageWaiting',
        'mobilenotification'               => 'MobileNotification',
        // Actualites
        'newsimage'                        => 'NewsImage',
        'newsaudio'                        => 'NewsAudio',
        'newsvideo'                        => 'NewsVideo',
        'newsarticle'                      => 'NewsArticle',
        // Evenements
        'event'                            => 'Event',
        // Communiques
        'statementimage'                   => 'StatementImage',
        'statementaudio'                   => 'StatementAudio',
        'statementarticle'                 => 'StatementArticle',
        'statementvideo'                   => 'StatementVideo',
        // Infos
        'infoimage'                        => 'InfoImage',
        'infoaudio'                        => 'InfoAudio',
        'infoarticle'                      => 'InfoArticle',
        'infovideo'                        => 'InfoVideo',
        // Cannes classics
        'fdcpagelaselectioncannesclassics' => 'FDCPageLaSelectionCannesClassics',
        // Medias
        'mediaimage'                       => 'MediaImage',
        'mediaimagesimple'                 => 'MediaImageSimple',
        'mediaaudio'                       => 'MediaAudio',
        'mediavideo'                       => 'MediaVideo',
        // Participer
        'fdcpageprepare'                   => 'FDCPagePrepare',
        'fdcpageparticipate'               => 'FDCPageParticipate',
        'fdcpageparticipatesection'        => 'FDCPageParticipateSection',
        // Espace presse
        'presshomepage'                    => 'PressHomepage',
        'pressstatementinfo'               => 'PressStatementInfo',
        'pressaccredit'                    => 'PressAccredit',
        'pressaccreditprocedure'           => 'PressAccreditProcedure',
        'pressguide'                       => 'PressGuide',
        'pressmedialibrary'                => 'PressMediaLibrary',
        'pressdownload'                    => 'PressDownload',
        'pressdownloadsection'             => 'PressDownloadSection',
        'pressprojection'                  => 'PressProjection',
        'presscinemamap'                   => 'PressCinemaMap',
        'contactpage'                      => 'ContactPage',
        // Pages
        'fdcpagefooter'                    => 'FDCPageFooter',
        'faqtheme'                         => 'FAQTheme',
        'faqpage'                          => 'FAQPage',
        // SEO + tetieres
        'fdcpageevent'                     => 'FDCPageEvent',
        'fdcpagewebtvchannels'             => 'FDCPageWebTvChannels',
        'fdcpagewebtvtrailers'             => 'FDCPageWebTvTrailers',
        'fdcpagenewsarticles'              => 'FDCPageNewsArticles',
        'fdcpagenewsaudios'                => 'FDCPageNewsAudios',
        'fdcpagenewsimages'                => 'FDCPageNewsImages',
        'fdcpagenewsvideos'                => 'FDCPageNewsVideos',
        'fdcpagelaselection'               => 'FDCPageLaSelection',
        'fdcpagelaselectioncinemaplage'    => 'FDCPageLaSelectionCinemaPlage',
        'fdcpagejury'                      => 'FDCPageJury',
        'fdcpageaward'                     => 'FDCPageAward',
        // Orange
        'orangeseriesandcie'               => 'OrangeSeriesAndCie',
        'orangeprogrammationocs'           => 'OrangeProgrammationOCS',
        'orangevideoondemand'              => 'OrangeVideoOnDemand',
        'orangestudio'                     => 'OrangeStudio',
        // deprecrated ??
        'presscinemaroom'                  => 'PressCinemaRoom'
    );

    /**
     * createLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/create/{id}", options={"expose"=true})
     */
    public function createAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $authChecker = $this->get('security.authorization_checker');
        $em = $this->get('doctrine')->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $response = new JsonResponse();

        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__ . " - Couldnt create the lock for entity '{$entity}' id '{$id}' locale '{$locale}', parameter id / entity / locale missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.',
            ));
        }

        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__ . " - Couldnt create the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.'
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:' . self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__ . " - Couldnt create the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de créer le verrou.'
            ));
        }

        $translations = array();
        if ($authChecker->isGranted('ROLE_FDC_TRANSLATOR_MASTER') === false) {
            $translations[] = $entity->findTranslationByLocale($locale);
        } else {
            $translations = $entity->getTranslations();
        }

        foreach ($translations as $trans) {
            if ($trans === null) {
                $logger->error(__CLASS__ . " - Couldnt create the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', translation not found");
                $response->setStatusCode(400);
                return $response->setData(array(
                    'message' => 'Impossible de créer le verrou.'
                ));
            }
        }

        foreach ($translations as $trans) {
            $trans->setLockedBy($user);
            $trans->setLockedAt(new DateTime());
        }
        $em->flush();

        $response->setData(array(
            'message' => 'Verrou crée.'
        ));

        return $response;
    }


    /**
     * checkAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/check/{id}", options={"expose"=true})
     */
    public function checkAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $em = $this->get('doctrine')->getManager();

        $response = new JsonResponse();
        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for entity '{$entity}' id '{$id}' locale '{$locale}', parameter id / entity / locale missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.',
            ));
        }
        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.',
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:' . self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.',
            ));
        }

        $trans = $entity->findTranslationByLocale($locale);
        if ($trans === null) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', translation not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        if ($trans->getLockedBy()) {
            $data = array(
                'locked' => true,
                'lockedBy' => ($trans->getLockedBy()->getFullName() != ' ') ? $trans->getLockedBy()->getFullName() : $trans->getLockedBy()->getUsername()
            );
        } else {
            $data = array(
                'locked' => false,
                'lockedBy' => null
            );
        }

        $response->setData($data);

        return $response;
    }

    /**
     * checkEntityAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/check_entity/{id}", options={"expose"=true})
     */
    public function checkEntityAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $em = $this->get('doctrine')->getManager();
        $authChecker = $this->get('security.authorization_checker');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $response = new JsonResponse();

        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for entity '{$entity}' id '{$id}' locale {$locale}, parameter id / entity / locale missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:' . self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__ . " - Couldnt verify the lock for entity " . self::$entityMapper[$entity] . " id '{$id}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de vérifier l\'existence du verrou.'
            ));
        }

        $translations = array();
        if ($authChecker->isGranted('ROLE_FDC_TRANSLATOR_MASTER') === false) {
            $translations[] = $entity->findTranslationByLocale($locale);
        } else {
            $translations = $entity->getTranslations();
        }

        foreach ($translations as $trans) {
            if ($trans === null) {
                $logger->error(__CLASS__ . " - Couldnt verify the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', translation not found");
                $response->setStatusCode(400);
                return $response->setData(array(
                    'message' => 'Impossible de vérifier l\'existence du verrou.',
                ));
            }
        }

        $response->setData(array(
            'success' => true
        ));

        foreach ($translations as $trans) {
            if ($trans->getLockedBy() == null) {
                $response->setData(array(
                    'error' => 0
                ));
            } else if ($trans->getLockedBy() !== null && $trans->getLockedBy()->getId() !== $user->getId()) {
                $response->setData(array(
                    'error' => 1
                ));
            }
        }

        return $response;
    }

    /**
     * deleteLockAction function.
     *
     * @access public
     * @param mixed $slug
     * @return void
     *
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/delete/{id}", options={"expose"=true})
     */
    public function deleteAction(Request $request, $id)
    {
        $entity = $request->get('entity');
        $locale = $request->get('locale');
        $logger = $this->get('logger');
        $em = $this->get('doctrine')->getManager();
        $authChecker = $this->get('security.authorization_checker');

        $response = new JsonResponse();

        if ($entity == null || $id == null || $locale == null) {
            $logger->error(__CLASS__ . " - Couldnt find the lock for entity '{$entity}' id '{$id}' locale '{$locale}', parameter id or entity missing");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        if (!isset(self::$entityMapper[$entity])) {
            $logger->error(__CLASS__ . " - Couldnt find the lock for the entity '{$entity}', entity not found in the entityMapper");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        $entity = $em->getRepository('BaseCoreBundle:' . self::$entityMapper[$entity])->findOneById($id);
        if ($entity === null) {
            $logger->error(__CLASS__ . " - Couldnt find the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', id not found");
            $response->setStatusCode(400);
            return $response->setData(array(
                'message' => 'Impossible de supprimer le verrou.'
            ));
        }

        $translations = array();
        if ($authChecker->isGranted('ROLE_FDC_TRANSLATOR_MASTER') === false) {
            $translations[] = $entity->findTranslationByLocale($locale);
        } else {
            $translations = $entity->getTranslations();
        }

        foreach ($translations as $trans) {
            if ($trans === null) {
                $logger->error(__CLASS__ . " - Couldnt create the lock for entity " . self::$entityMapper[$entity] . " id '{$id}' locale '{$locale}', translation not found");
                $response->setStatusCode(400);
                return $response->setData(array(
                    'message' => 'Impossible de créer le verrou.'
                ));
            }
        }

        foreach ($translations as $trans) {
            $trans->setLockedBy(null);
            $trans->setLockedAt(null);
        }
        $em->flush();

        $response->setData(array(
            'message' => 'Verrou supprimé.<br/> La page va se rafraîchir dans 5 secondes.'
        ));

        return $response;
    }
}
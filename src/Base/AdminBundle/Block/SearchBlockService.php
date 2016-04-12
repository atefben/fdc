<?php

namespace Base\AdminBundle\Block;

use Base\AdminBundle\Form\Type\DashboardSearchType;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

/**
 * SearchBlockService class.
 *
 * \@extends BaseBlockService
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class SearchBlockService extends BaseBlockService
{
    /**
     * securityContext
     *
     * @var mixed
     * @access private
     */
    private $securityContext;

    private $em;

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'Translator stats';
    }

    /**
     * setSecurityContext function.
     *
     * @access public
     * @param mixed $securityContext
     * @return void
     */
    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function setEntityManager($em)
    {
        $this->em = $em;
    }

    public function setFormFactory($formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function setRequestStack($requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function setPool($pool)
    {
        $this->pool = $pool;
    }

    /**
     * getDefaultSettings function.
     *
     * @access public
     * @return void
     */
    public function getDefaultSettings()
    {
        return array();
    }

    /**
     * validateBlock function.
     *
     * @access public
     * @param ErrorElement $errorElement
     * @param BlockInterface $block
     * @return void
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    /**
     * buildEditForm function.
     *
     * @access public
     * @param FormMapper $formMapper
     * @param BlockInterface $block
     * @return void
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function getAdmins()
    {
       return array(
            'news' => array(
                'article' => $this->pool->getAdminByAdminCode('base.admin.news_article'),
                'audio' => $this->pool->getAdminByAdminCode('base.admin.news_audio'),
                'video' => $this->pool->getAdminByAdminCode('base.admin.news_video'),
                'image' => $this->pool->getAdminByAdminCode('base.admin.news_image')
            ) ,
            'statements' => array(
                'article' => $this->pool->getAdminByAdminCode('base.admin.statement_article'),
                'audio' => $this->pool->getAdminByAdminCode('base.admin.statement_audio'),
                'video' => $this->pool->getAdminByAdminCode('base.admin.statement_video'),
                'image' => $this->pool->getAdminByAdminCode('base.admin.statement_image')
            ) ,
            'infos' => array(
                'article' => $this->pool->getAdminByAdminCode('base.admin.info_article'),
                'audio' => $this->pool->getAdminByAdminCode('base.admin.info_audio'),
                'video' => $this->pool->getAdminByAdminCode('base.admin.info_video'),
                'image' => $this->pool->getAdminByAdminCode('base.admin.info_image')
            ) ,
            'videos' => $this->pool->getAdminByAdminCode('base.admin.media_video'),
            'audios' => $this->pool->getAdminByAdminCode('base.admin.media_audio'),
            'photos' => $this->pool->getAdminByAdminCode('base.admin.media_image'),
            'themes' => $this->pool->getAdminByAdminCode('base.admin.theme'),
            'tags' => $this->pool->getAdminByAdminCode('base.admin.tag'),
            'webtvs' => $this->pool->getAdminByAdminCode('base.admin.web_tv'),
            'images' => $this->pool->getAdminByAdminCode('base.admin.media_image_simple'),
            'pages' => array(
                // general
                'Homepage'=> $this->pool->getAdminByAdminCode('base.admin.homepage'),
                'FDCPageWebTvLive'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_web_tv_live'),
                'FDCPageWaiting' => $this->pool->getAdminByAdminCode('base.admin.fdc_page_waiting'),
                // events
                'Event'=> $this->pool->getAdminByAdminCode('base.admin.event'),
                // cannes classics
                'FDCPageLaSelectionCannesClassics'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_la_selection_cannes_classics'),
                // participer
                'FDCPagePrepare'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_prepare'),
                'FDCPageParticipate'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_participate'),
                'FDCPageParticipateSection'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_participate_section'),
                // espace presse
                'PressHomepage'=> $this->pool->getAdminByAdminCode('base.admin.press_homepage'),
                'PressStatementInfo'=> $this->pool->getAdminByAdminCode('base.admin.press_statement_info'),
                'PressAccredit'=> $this->pool->getAdminByAdminCode('base.admin.press_accredit'),
                'PressAccreditProcedure'=> $this->pool->getAdminByAdminCode('base.admin.press_accredit_procedure'),
                'PressGuide'=> $this->pool->getAdminByAdminCode('base.admin.press_guide'),
                'PressMediaLibrary'=> $this->pool->getAdminByAdminCode('base.admin.press_media_library'),
                'PressDownload'=> $this->pool->getAdminByAdminCode('base.admin.press_download'),
                'PressDownloadSection'=> $this->pool->getAdminByAdminCode('base.admin.press_download_section'),
                'PressProjection'=> $this->pool->getAdminByAdminCode('base.admin.press_projection'),
                'PressCinemaMap'=> $this->pool->getAdminByAdminCode('base.admin.press_cinema_map'),
                'ContactPage'=> $this->pool->getAdminByAdminCode('base.admin.contact_page'),
                // pages
                'FDCPageFooter'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_footer'),
                // seo + tetieres
                'FDCPageEvent'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_event'),
                'FDCPageWebTvChannels'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_web_tv_channels'),
                'FDCPageWebTvTrailers'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_web_tv_trailers'),
                'FDCPageNewsArticles'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_news_articles'),
                'FDCPageNewsAudios'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_news_audios'),
                'FDCPageNewsVideos'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_news_videos'),
                'FDCPageNewsImages'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_news_images'),
                'FDCPageLaSelection'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_la_selection'),
                'FDCPageLaSelectionCinemaPlage'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_la_selection_cinema_plage'),
                'FDCPageJury'=> $this->pool->getAdminByAdminCode('base.admin.fdc_page_jury'),
                'FDCPageAward' => $this->pool->getAdminByAdminCode('base.admin.fdc_page_award')
            )
        );
    }

    private static $repositoriesTranslatorStats = array(
        'news' => array(
            'BaseCoreBundle:NewsArticle',
            'BaseCoreBundle:NewsAudio',
            'BaseCoreBundle:NewsVideo',
            'BaseCoreBundle:NewsImage',
        ),
        'videos' => array(
            'BaseCoreBundle:MediaVideo'
        ),
        'audios' => array(
            'BaseCoreBundle:MediaAudio'
        ),
        'photos' => array(
            'BaseCoreBundle:MediaImage'
        ),
        'statements' => array(
            'BaseCoreBundle:StatementArticle',
            'BaseCoreBundle:StatementAudio',
            'BaseCoreBundle:StatementImage',
            'BaseCoreBundle:StatementVideo'
        ),
        'infos' => array(
            'BaseCoreBundle:InfoArticle',
            'BaseCoreBundle:InfoAudio',
            'BaseCoreBundle:InfoImage',
            'BaseCoreBundle:InfoVideo'
        ),
        'themes' => array(
            'BaseCoreBundle:Theme',
        ),
        'tags' => array(
            'BaseCoreBundle:Tag'
        ),
        'webtv' => array(
            'BaseCoreBundle:WebTv'
        ),
        'images' => array(
            'BaseCoreBundle:MediaImageSimple'
        ),
        'pages' => array(
            // general
            'BaseCoreBundle:Homepage',
            'BaseCoreBundle:FDCPageWebTvLive',
            'BaseCoreBundle:FDCPageWaiting',
            // events
            'BaseCoreBundle:Event',
            // cannes classics
            'BaseCoreBundle:FDCPageLaSelectionCannesClassics',
            // participer
            'BaseCoreBundle:FDCPagePrepare',
            'BaseCoreBundle:FDCPageParticipate',
            'BaseCoreBundle:FDCPageParticipateSection',
            // espace presse
            'BaseCoreBundle:PressHomepage',
            'BaseCoreBundle:PressStatementInfo',
            'BaseCoreBundle:PressAccredit',
            'BaseCoreBundle:PressAccreditProcedure',
            'BaseCoreBundle:PressGuide',
            'BaseCoreBundle:PressMediaLibrary',
            'BaseCoreBundle:PressDownload',
            'BaseCoreBundle:PressDownloadSection',
            'BaseCoreBundle:PressProjection',
            'BaseCoreBundle:PressCinemaMap',
            'BaseCoreBundle:ContactPage',
            // pages
            'BaseCoreBundle:FDCPageFooter',
            // seo + tetieres
            'BaseCoreBundle:FDCPageEvent',
            'BaseCoreBundle:FDCPageWebTvChannels',
            'BaseCoreBundle:FDCPageWebTvTrailers',
            'BaseCoreBundle:FDCPageNewsArticles',
            'BaseCoreBundle:FDCPageNewsAudios',
            'BaseCoreBundle:FDCPageNewsVideos',
            'BaseCoreBundle:FDCPageNewsImages',
            'BaseCoreBundle:FDCPageLaSelection',
            'BaseCoreBundle:FDCPageLaSelectionCinemaPlage',
            'BaseCoreBundle:FDCPageJury',
            'BaseCoreBundle:FDCPageAward'
        )
    );

    private static $dashboards = array(
        'Homepage' => 'Général',
        'FDCPageWebTvLive' => 'Général',
        'FDCPageWaiting' => 'Général',
        // events
        'Event' => 'Événements',
        // cannes classics
        'FDCPageLaSelectionCannesClassics' => 'Cannes Classics',
        // participer
        'FDCPagePrepare' => 'Participer',
        'FDCPageParticipate' => 'Participer',
        'FDCPageParticipateSection' => 'Participer',
        // espace presse
        'PressHomepage' => 'Espace presse',
        'PressStatementInfo' => 'Espace presse',
        'PressAccredit' => 'Espace presse',
        'PressAccreditProcedure' => 'Espace presse',
        'PressGuide' => 'Espace presse',
        'PressMediaLibrary' => 'Espace presse',
        'PressDownload' => 'Espace presse',
        'PressDownloadSection' => 'Espace presse',
        'PressProjection' => 'Espace presse',
        'PressCinemaMap' => 'Espace presse',
        'ContactPage' => 'Espace presse',
        // pages
        'FDCPageFooter' => 'Pages',
        // seo + tetieres
        'FDCPageEvent' => 'SEO + TETIÈRES',
        'FDCPageWebTvChannels' => 'SEO + TETIÈRES',
        'FDCPageWebTvTrailers' => 'SEO + TETIÈRES',
        'FDCPageNewsArticles' => 'SEO + TETIÈRES',
        'FDCPageNewsAudios' => 'SEO + TETIÈRES',
        'FDCPageNewsVideos' => 'SEO + TETIÈRES',
        'FDCPageNewsImages' => 'SEO + TETIÈRES',
        'FDCPageLaSelection' => 'SEO + TETIÈRES',
        'FDCPageLaSelectionCinemaPlage' => 'SEO + TETIÈRES',
        'FDCPageJury' => 'SEO + TETIÈRES',
        'FDCPageAward' => 'SEO + TETIÈRES',
    );

    private static $repositoriesSearch = array(
        'news' => 'BaseCoreBundle:News',
        'videos' => 'BaseCoreBundle:MediaVideo',
        'audios' => 'BaseCoreBundle:MediaAudio',
        'photos' => 'BaseCoreBundle:MediaImage',
        'statements' => 'BaseCoreBundle:Statement',
        'infos' => 'BaseCoreBundle:Info',
        'themes' => 'BaseCoreBundle:Theme',
        'tags' => 'BaseCoreBundle:Tag',
        'webtvs' => 'BaseCoreBundle:WebTv',
        'images' => 'BaseCoreBundle:MediaImageSimple',
        'pages' => array(
            // general
            'BaseCoreBundle:Homepage',
            'BaseCoreBundle:FDCPageWebTvLive',
            'BaseCoreBundle:FDCPageWaiting',
            // events
            'BaseCoreBundle:Event',
            // cannes classics
            'BaseCoreBundle:FDCPageLaSelectionCannesClassics',
            // participer
            'BaseCoreBundle:FDCPagePrepare',
            'BaseCoreBundle:FDCPageParticipate',
            'BaseCoreBundle:FDCPageParticipateSection',
            // espace presse
            'BaseCoreBundle:PressHomepage',
            'BaseCoreBundle:PressStatementInfo',
            'BaseCoreBundle:PressAccredit',
            'BaseCoreBundle:PressAccreditProcedure',
            'BaseCoreBundle:PressGuide',
            'BaseCoreBundle:PressMediaLibrary',
            'BaseCoreBundle:PressDownload',
            'BaseCoreBundle:PressDownloadSection',
            'BaseCoreBundle:PressProjection',
            'BaseCoreBundle:PressCinemaMap',
            'BaseCoreBundle:ContactPage',
            // pages
            'BaseCoreBundle:FDCPageFooter',
            // seo + tetieres
            'BaseCoreBundle:FDCPageEvent',
            'BaseCoreBundle:FDCPageWebTvChannels',
            'BaseCoreBundle:FDCPageWebTvTrailers',
            'BaseCoreBundle:FDCPageNewsArticles',
            'BaseCoreBundle:FDCPageNewsAudios',
            'BaseCoreBundle:FDCPageNewsVideos',
            'BaseCoreBundle:FDCPageNewsImages',
            'BaseCoreBundle:FDCPageLaSelection',
            'BaseCoreBundle:FDCPageLaSelectionCinemaPlage',
            'BaseCoreBundle:FDCPageJury',
            'BaseCoreBundle:FDCPageAward'
        )
    );

    /**
     * execute function.
     *
     * @access public
     * @param BlockContextInterface $blockContext
     * @param Response $response (default: null)
     * @return void
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user = $this->securityContext->getToken()->getUser();
        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());
        $form = $this->formFactory->create(new DashboardSearchType($this->securityContext));
        $request = $this->requestStack->getCurrentRequest();
        $params = $request->query->get('dashboard_search_type');
        $statuses = NewsArticleTranslation::getStatuses();
        $locales = array();
        $status = null;
        $entities = array();
        $entitiesAll = array();
        $type = null;

        // get locales / status by current user
        if ($this->securityContext->isGranted('ROLE_TRANSLATOR')) {
            if (isset($params['translationStatus']) && $params['translationStatus'] == '1') {
                $status = NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING;
            } else {
                $status = NewsArticleTranslation::STATUS_TRANSLATION_PENDING;
            }
            if ($this->securityContext->isGranted('ROLE_TRANSLATOR_FR')) {
                $locales[] = 'fr';
            } else if ($this->securityContext->isGranted('ROLE_TRANSLATOR_EN')) {
                $locales[] = 'en';
            } else if ($this->securityContext->isGranted('ROLE_TRANSLATOR_ES')) {
                $locales[] = 'es';
            } else if ($this->securityContext->isGranted('ROLE_TRANSLATOR_ZH')) {
                $locales[] = 'zh';
            }
        } else if ($this->securityContext->isGranted('ROLE_TRANSLATOR_MASTER')) {
            $locales = array('fr', 'en', 'es', 'zh');
            $status = $params['status'];

            if (!isset($params['status'])) {
                $status = NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING;
            }
        }


        // TRANSLATOR STATS
        if (isset($statuses[$status])) {
            $statusName = $statuses[$status];
        }

        foreach (self::$repositoriesTranslatorStats as $key => $repository) {
            if (is_array($repository)) {
                $counts[$key] = 0;
                foreach ($repository as $rep) {
                    $counts[$key] += $this->em->getRepository($rep)->countByStatusAndLocales($status, $locales);
                }
            } else {
                $counts[$key] = $this->em->getRepository($repository)->countByStatusAndLocales($status, $locales);
            }
        }


        // SEARCH
        $params['status'] = $status;
        $priorityStatuses = News::getPriorityStatuses();

        if (count($_GET) == 0 ||
            (isset($_GET['dashboard_search_type']) && isset($_GET['dashboard_search_type']['reset']) && $_GET['dashboard_search_type']['reset'] == '1')) {
            $params['priorityStatus'] = NewsArticle::PRIORITY_STATUS_NOW;
            foreach (self::$repositoriesSearch as $type => $rep) {
                if (is_array($rep)) {
                    $entitiesAll[$type] = array();
                    foreach ($rep as $repository) {
                        $entitiesAll[$type] = array_merge($entitiesAll[$type], $this->em->getRepository($repository)->dashboardSearch($params, $locales));
                    }
                } else {
                    $entitiesAll[$type] = $this->em->getRepository($rep)->dashboardSearch($params, $locales);
                }
            }
        } else {
            if (isset($params['type']) && isset(self::$repositoriesSearch[$params['type']])) {
                $type = $params['type'];
                if (is_array(self::$repositoriesSearch[$params['type']])) {
                    foreach (self::$repositoriesSearch[$params['type']] as $rep) {
                        $entities = array_merge($entities, $this->em->getRepository($rep)->dashboardSearch($params, $locales));
                    }
                } else {
                    $entities = $this->em->getRepository(self::$repositoriesSearch[$params['type']])->dashboardSearch($params, $locales);
                }
            }
        }


        return $this->renderResponse('BaseAdminBundle:Block:search.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'form' =>  $form->createView(),
            'params' => $params,
            'priorityStatuses' => $priorityStatuses,
            'entities' => $entities,
            'entitiesAll' => $entitiesAll,
            'admins' => $this->getAdmins(),
            'dashboards' => self::$dashboards,
            'type' => $type,
            'statusName' => $statusName,
            'counts' =>  $counts,

        ), $response);
    }
}
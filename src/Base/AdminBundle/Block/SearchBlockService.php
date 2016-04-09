<?php

namespace Base\AdminBundle\Block;

use Base\AdminBundle\Form\Type\DashboardSearchType;
use Base\CoreBundle\Entity\News;
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
        $form = $this->formFactory->create(new DashboardSearchType());
        $request = $this->requestStack->getCurrentRequest();
        $params = $request->query->get('dashboard_search_type');
        $repositories = array(
            'news' => 'BaseCoreBundle:News',
            'videos' => 'BaseCoreBundle:MediaVideo',
            'audios' => 'BaseCoreBundle:MediaAudio',
            'photos' => 'BaseCoreBundle:MediaImage',
            'statements' => 'BaseCoreBundle:Statement',
            'infos' => 'BaseCoreBundle:Info',
            'themes' => 'BaseCoreBundle:Theme',
            'tags' => 'BaseCoreBundle:Tag',
            'webtvs' => 'BaseCoreBundle:WebTv',
            'images' => 'BaseCoreBundle:MediaImageSimple'
        );
        $locales = array();
        $status = null;
        $entities = array();

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
            if (isset($params['translationStatus']) && $params['translationStatus'] == '1') {
                $status = NewsArticleTranslation::STATUS_TRANSLATION_PENDING;
            } else {
                $status = NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING;
            }
        }

        $params['status'] = $status;
        $priorityStatuses = News::getPriorityStatuses();


        if (isset($params['type']) && isset($repositories[$params['type']])) {
            $entities = $this->em->getRepository($repositories[$params['type']])->dashboardSearch($params, $locales);
        }


        return $this->renderResponse('BaseAdminBundle:Block:search.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'form' =>  $form->createView(),
            'params' => $params,
            'priorityStatuses' => $priorityStatuses,
            'entities' => $entities
        ), $response);
    }
}
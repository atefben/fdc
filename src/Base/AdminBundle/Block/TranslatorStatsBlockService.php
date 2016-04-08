<?php

namespace Base\AdminBundle\Block;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

/**
 * TranslatorStatsBlockService class.
 *
 * \@extends BaseBlockService
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class TranslatorStatsBlockService extends BaseBlockService
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
        $repositories = array(
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
            )
        );

        $statuses = NewsArticleTranslation::getStatuses();
        $status = null;
        $counts = array();
        $locales = array();
        $statusName = null;

        if ($this->securityContext->isGranted('ROLE_TRANSLATOR')) {
            $status = NewsArticleTranslation::STATUS_TRANSLATION_PENDING;
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
            $status = NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING;
        }

        if (isset($statuses[$status])) {
            $statusName = $statuses[$status];
        }

        foreach ($repositories as $key => $repository) {
            if (is_array($repository)) {
                $counts[$key] = 0;
                foreach ($repository as $rep) {
                    $counts[$key] += $this->em->getRepository($rep)->countByStatusAndLocales($status, $locales);
                }
            } else {
                $counts[$key] = $this->em->getRepository($repository)->countByStatusAndocales($status, $locales);
            }
        }

        return $this->renderResponse('BaseAdminBundle:Block:translator_stats.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'statusName' => $statusName,
            'counts' =>  $counts,
        ), $response);
    }
}
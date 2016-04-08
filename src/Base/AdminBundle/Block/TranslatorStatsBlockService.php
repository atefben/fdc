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
                'BaseCoreBundle:NewsAudio',
                'BaseCoreBundle:NewsVideo',
                'BaseCoreBundle:NewsArticle',
                'BaseCoreBundle:NewsImage',
            )
        );


        if ($this->securityContext->is_granted('ROLE_TRANSLATOR')) {
            $status = NewsArticleTranslation::STATUS_TRANSLATION_PENDING;
        } else {
            $status = NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING;
        }

        foreach ($repositories as $key => $repository) {
            if (is_array($repository)) {
                $count[$key] = 0;
                foreach ($repository as $rep) {
                    $count[$key] += $this->em->getRepository($rep)->countByStatus($status);
                }
            } else {
                $count[$key] = $this->em->getRepository($repository)->countByStatus($status);
            }
        }

        var_dump($count);
        die();

        return $this->renderResponse('BaseAdminBundle:Block:translator_stats.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'count' =>  $count,
        ), $response);
    }
}
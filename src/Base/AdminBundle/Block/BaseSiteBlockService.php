<?php

namespace Base\AdminBundle\Block;

use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

/**
 * BaseSiteBlockService class.
 * 
 * \@extends BaseBlockService
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class BaseSiteBlockService extends BaseBlockService
{
    /**
     * securityContext
     * 
     * @var mixed
     * @access private
     */
    private $securityContext;

    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'Base Sites';
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

        return $this->renderResponse('BaseAdminBundle:Block:sites.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'sites' =>  $user->getSites()
            ), $response);
    }
}
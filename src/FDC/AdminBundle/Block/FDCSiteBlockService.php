<?php

namespace FDC\AdminBundle\Block;

use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

class FDCSiteBlockService extends BaseBlockService
{
    private $securityContext;

    public function getName()
    {
        return 'FDC Sites';
    }
    
    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function getDefaultSettings()
    {
        return array();
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user = $this->securityContext->getToken()->getUser();

        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());

        return $this->renderResponse('FDCAdminBundle:Block:sites.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'sites' =>  $user->getSites()
            ), $response);
    }
}
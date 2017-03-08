<?php

namespace FDC\CourtMetrageBundle\Manager;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Class ExceptionManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class ExceptionManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * constructor.
     * @param EntityManager $entityManager
     * @param TwigEngine $twigEngine
     */
    public function __construct(EntityManager $entityManager, TwigEngine $twigEngine)
    {
        $this->em = $entityManager;
        $this->templating = $twigEngine;
    }

    /**
     * @param $locale
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render404Page($locale)
    {
        // add logic ?
        
        return $this->templating->renderResponse('@FDCCourtMetrage/exceptions/error404.html.twig', [
            'params' => []
        ]);        
    }
}
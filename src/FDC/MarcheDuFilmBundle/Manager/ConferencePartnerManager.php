<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18.01.2017
 * Time: 13:12
 */

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ConferencePartnerManager
 *
 * @package FDC\MarcheDuFilmBundle\Manager
 */
class ConferencePartnerManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getConferencePartnerPageBySlug($slug)
    {
        return $this->em
            ->getRepository(MdfConferencePartnerTranslation::class)
            ->getConferencePartnerPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);
    }
}
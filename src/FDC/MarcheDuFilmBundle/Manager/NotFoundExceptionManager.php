<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.02.2017
 * Time: 14:42
 */

namespace FDC\MarcheDuFilmBundle\Manager;


use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\Mdf404Translation;
use Symfony\Component\HttpFoundation\RequestStack;

class NotFoundExceptionManager
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function get404PageContent($locale)
    {
        return $this->em
            ->getRepository(Mdf404Translation::class)
            ->findOneBy(array(
                'locale' => $locale
            ));
    }
}

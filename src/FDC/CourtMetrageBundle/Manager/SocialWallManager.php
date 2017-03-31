<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmSocialWall;

/**
 * Class SocialWallManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class SocialWallManager
{
    const POSTS_LIMIT = 26;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * SocialWallManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return array
     */
    public function getRandomPosts()
    {
        return $this
            ->em
            ->getRepository(CcmSocialWall::class)
            ->getRandomPosts(self::POSTS_LIMIT);
    }
}

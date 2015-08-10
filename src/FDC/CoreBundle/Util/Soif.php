<?php

namespace FDC\CoreBundle\Util;

use \DateTime;

trait Soif
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $soifUpdatedAt;

    /**
     * Set soifUpdatedAt
     *
     * @param \DateTime $soifUpdatedAt
     * @return FilmPrize
     */
    public function setSoifUpdatedAt($soifUpdatedAt)
    {
        $this->soifUpdatedAt = $soifUpdatedAt;

        return $this;
    }

    /**
     * Get soifUpdatedAt
     *
     * @return \DateTime 
     */
    public function getSoifUpdatedAt()
    {
        return $this->soifUpdatedAt;
    }
}

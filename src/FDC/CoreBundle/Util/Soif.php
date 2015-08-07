<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

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

trait Time
{
    /**
     * @ORM\PrePersist()
     */
    public function prePersistTime()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdateTime()
    {
        $this->updatedAt = new DateTime();
    }
}

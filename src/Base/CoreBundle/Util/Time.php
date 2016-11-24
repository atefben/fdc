<?php

namespace Base\CoreBundle\Util;

use DateTime;
use JMS\Serializer\Annotation\Groups;

/**
 * Time trait.
 * @author  Antoine Mineau
 * @company Ohwee
 */
trait Time
{
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"time"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"time"})
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        if ($this->getCreatedAt() == null) {
            $this->createdAt = new DateTime();
        }

        if ($this->getUpdatedAt() == null) {
            $this->updatedAt = new DateTime();
        }
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * Set createdAt
     * @param \DateTime $createdAt
     * @return FilmPrize
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     * @param \DateTime $updatedAt
     * @return FilmPrize
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
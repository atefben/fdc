<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Settings
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Settings
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getFestivalStartsAt() <= this.getFestivalEndsAt()",
     *     message="La date de début doit etre inférieure à la date de fin"
     * )
     */
    protected $festivalStartsAt;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getFestivalEndsAt() >= this.getFestivalStartsAt()",
     *     message="La date de fin doit etre supérieure à la date de début"
     * )
     */
    protected $festivalEndsAt;

    public function getYear()
    {
        return $this->getFestivalStartsAt()->format('Y');
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set festivalStartsAt
     *
     * @param \DateTime $festivalStartsAt
     * @return Settings
     */
    public function setFestivalStartsAt($festivalStartsAt)
    {
        $this->festivalStartsAt = $festivalStartsAt;

        return $this;
    }

    /**
     * Get festivalStartsAt
     *
     * @return \DateTime 
     */
    public function getFestivalStartsAt()
    {
        return $this->festivalStartsAt;
    }

    /**
     * Set festivalEndsAt
     *
     * @param \DateTime $festivalEndsAt
     * @return Settings
     */
    public function setFestivalEndsAt($festivalEndsAt)
    {
        $this->festivalEndsAt = $festivalEndsAt;

        return $this;
    }

    /**
     * Get festivalEndsAt
     *
     * @return \DateTime 
     */
    public function getFestivalEndsAt()
    {
        return $this->festivalEndsAt;
    }
}

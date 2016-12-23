<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmCredits
 *
 * @ORM\Table(name="old_film_credits", uniqueConstraints={@ORM\UniqueConstraint(name="fonction", columns={"fonction"})})
 * @ORM\Entity
 */
class OldFilmCredits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="fonction", type="integer", nullable=false)
     */
    protected $fonction;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive;



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
     * Set fonction
     *
     * @param integer $fonction
     * @return OldFilmCredits
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return integer 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return OldFilmCredits
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}

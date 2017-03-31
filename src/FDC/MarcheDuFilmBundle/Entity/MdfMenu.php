<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfMenu
 * @ORM\Table(name="mdf_menu")
 * @ORM\Entity
 */
class MdfMenu
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $programProjectsIsActive = true;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $programEventsIsActive = true;
    

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        $string = "Menu configuration";

        return $string;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isProgramProjectsIsActive()
    {
        return $this->programProjectsIsActive;
    }

    /**
     * @param boolean $programProjectsIsActive
     */
    public function setProgramProjectsIsActive($programProjectsIsActive)
    {
        $this->programProjectsIsActive = $programProjectsIsActive;
    }

    /**
     * @return boolean
     */
    public function isProgramEventsIsActive()
    {
        return $this->programEventsIsActive;
    }

    /**
     * @param boolean $programEventsIsActive
     */
    public function setProgramEventsIsActive($programEventsIsActive)
    {
        $this->programEventsIsActive = $programEventsIsActive;
    }
}

<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmMainNavCollection
 *
 * @ORM\Table(name="ccm_main_nav_collection")
 * @ORM\Entity
 */
class CcmMainNavCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMainNav", inversedBy="mainNavsCollection")
     * @ORM\JoinColumn(name="main_nav_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank()
     */
    private $mainNav;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMenu", inversedBy="mainNavsCollection")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $menu;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMainNav()
    {
        return $this->mainNav;
    }

    /**
     * @param mixed $mainNav
     */
    public function setMainNav($mainNav)
    {
        $this->mainNav = $mainNav;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}


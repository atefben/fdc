<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmSubNavCollection
 *
 * @ORM\Table(name="ccm_sub_nav_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmSubNavCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmSubNav", inversedBy="subNavsCollection")
     * @ORM\JoinColumn(name="sub_nav_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank()
     */
    private $subNav;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMainNav", inversedBy="subNavsCollection")
     * @ORM\JoinColumn(name="main_nav_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $mainNav;

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
    public function getSubNav()
    {
        return $this->subNav;
    }

    /**
     * @param mixed $subNav
     */
    public function setSubNav($subNav)
    {
        $this->subNav = $subNav;
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


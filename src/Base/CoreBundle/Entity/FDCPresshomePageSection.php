<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FDCPressHomepageSection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPressHomepageSection
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $class;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var FDCPressHomepage
     *
     * @ORM\ManyToOne(targetEntity="FDCPressHomepage", inversedBy="section")
     */
    protected $homepage;

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
     * Set class
     *
     * @param string $class
     * @return FDCPressHomepageSection
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FDCPressHomepageSection
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\FDCPressHomepage $homepage
     * @return FDCPressHomepageSection
     */
    public function setHomepage(\Base\CoreBundle\Entity\FDCPressHomepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\FDCPressHomepage 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }
}

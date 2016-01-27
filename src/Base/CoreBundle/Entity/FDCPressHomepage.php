<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FDCPressHomepage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPressHomepage
{
    use Translatable;
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var FDCPressHomepageSection
     *
     * @ORM\OneToMany(targetEntity="FDCPressHomepageSection", mappedBy="homepage", cascade={"persist"})
     *
     */
    private $section;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->section = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new ArrayCollection();
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
     * Add section
     *
     * @param \Base\CoreBundle\Entity\FDCPressHomepageSection $section
     * @return FDCPressHomepage
     */
    public function addSection(\Base\CoreBundle\Entity\FDCPressHomepageSection $section)
    {
        $this->section[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param \Base\CoreBundle\Entity\FDCPressHomepageSection $section
     */
    public function removeSection(\Base\CoreBundle\Entity\FDCPressHomepageSection $section)
    {
        $this->section->removeElement($section);
    }

    /**
     * Get section
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSection()
    {
        return $this->section;
    }
}

<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateHasSection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateHasSection
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
     * @ORM\OneToOne(targetEntity="FDCPageParticipateSection", cascade={"persist"}, orphanRemoval=false)
     */
    protected $section;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressHomepage
     *
     * @ORM\ManyToOne(targetEntity="FDCPageParticipate", inversedBy="downloadSection")
     */
    protected $download;


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
     * Set position
     *
     * @param integer $position
     * @return FDCPageParticipateHasSection
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
     * Set section
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSection $section
     * @return FDCPageParticipateHasSection
     */
    public function setSection(\Base\CoreBundle\Entity\FDCPageParticipateSection $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipateSection
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set download
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipate $download
     * @return FDCPageParticipateHasSection
     */
    public function setDownload(\Base\CoreBundle\Entity\FDCPageParticipate $download = null)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipate
     */
    public function getDownload()
    {
        return $this->download;
    }
}

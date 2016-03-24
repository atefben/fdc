<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * FDCPageParticipateSectionWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "typeone" = "FDCPageParticipateSectionWidgetTypeone",
 * })
 */
abstract class FDCPageParticipateSectionWidget implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var FDCPageParticipateSection
     *
     * @ORM\ManyToOne(targetEntity="FDCPageParticipateSection", inversedBy="widgets")
     */
    protected $pressDownload;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
     */
    private $lockedContent;


    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
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
     * Set lockedContent
     *
     * @param boolean $lockedContent
     * @return FDCPageParticipateSectionWidget
     */
    public function setLockedContent($lockedContent)
    {
        $this->lockedContent = $lockedContent;

        return $this;
    }

    /**
     * Get lockedContent
     *
     * @return boolean 
     */
    public function getLockedContent()
    {
        return $this->lockedContent;
    }

    /**
     * Set FDCPageParticipate
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSection $FDCPageParticipate
     * @return FDCPageParticipateSectionWidget
     */
    public function setFDCPageParticipate(\Base\CoreBundle\Entity\FDCPageParticipateSection $FDCPageParticipate = null)
    {
        $this->FDCPageParticipate = $FDCPageParticipate;

        return $this;
    }

    /**
     * Get FDCPageParticipate
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipateSection
     */
    public function getFDCPageParticipate()
    {
        return $this->FDCPageParticipate;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FDCPageParticipateSectionWidget
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
}

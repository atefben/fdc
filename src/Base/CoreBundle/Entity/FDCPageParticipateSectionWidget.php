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
 *  "typetwo" = "FDCPageParticipateSectionWidgetTypetwo",
 *  "typethree" = "FDCPageParticipateSectionWidgetTypethree",
 *  "typefour" = "FDCPageParticipateSectionWidgetTypefour",
 *  "typefive" = "FDCPageParticipateSectionWidgetTypefive",
 *  "subtitle" = "FDCPageParticipateSectionWidgetSubTitle",
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
     * @ORM\JoinColumn(nullable=true)
     */
    protected $pressDownload;


    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #' . $this->getId();
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
     * Set pressDownload
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSection $pressDownload
     * @return FDCPageParticipateSectionWidget
     */
    public function setPressDownload(\Base\CoreBundle\Entity\FDCPageParticipateSection $pressDownload = null)
    {
        $this->pressDownload = $pressDownload;

        return $this;
    }

    /**
     * Get pressDownload
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipateSectionWidget
     */
    public function getPressDownload()
    {
        return $this->pressDownload;
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

<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCPageParticipate
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipate implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $image;

    /**
     * @var FDCPageParticipateHasSection
     * @ORM\OneToMany(targetEntity="FDCPageParticipateHasSection", mappedBy="download", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $downloadSection;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->downloadSection = new ArrayCollection();
    }

    public function __toString()
    {
        return "Strate";
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
     * Add FDCPageParticipateSection
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateHasSection $downloadSection
     * @return FDCPageParticipateHasSection
     */
    public function addDownloadSection(\Base\CoreBundle\Entity\FDCPageParticipateHasSection $downloadSection)
    {
        $downloadSection->setDownload($this);
        $this->downloadSection->add($downloadSection);
    }

    /**
     * Remove downloadSection
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateHasSection $downloadSection
     */
    public function removeDownloadSection(\Base\CoreBundle\Entity\FDCPageParticipateHasSection $downloadSection)
    {
        $this->downloadSection->removeElement($downloadSection);
    }

    /**
     * Get downloadSection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDownloadSection()
    {
        return $this->downloadSection;
    }

    /**
     * @param PressDownloadSection $downloadSection
     */
    public function setDownloadSection($downloadSection)
    {

        foreach($downloadSection as $section)
        {
            $section->setDownload($this);
        }

        $this->downloadSection = $downloadSection;
    }

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return FDCPageParticipateSectionWidgetTypefour
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

}

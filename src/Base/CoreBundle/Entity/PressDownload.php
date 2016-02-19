<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressDownload
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownload
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
     * @var PressDownloadHasSection
     * @ORM\OneToMany(targetEntity="PressDownloadHasSection", mappedBy="download", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $downloadSection;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * ArrayCollection
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
     * Add downloadSection
     *
     * @param \Base\CoreBundle\Entity\PressDownloadHasSection $downloadSection
     * @return PressDownloadHasSection
     */
    public function addDownloadSection(\Base\CoreBundle\Entity\PressDownloadHasSection $downloadSection)
    {
        $downloadSection->setDownload($this);
        $this->downloadSection->add($downloadSection);
    }
    
    /**
     * Remove downloadSection
     *
     * @param \Base\CoreBundle\Entity\PressDownloadHasSection $downloadSection
     */
    public function removeDownloadSection(\Base\CoreBundle\Entity\PressDownloadHasSection $downloadSection)
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return PressDownload
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }
}

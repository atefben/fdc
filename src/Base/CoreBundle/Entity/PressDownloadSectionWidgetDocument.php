<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadSectionWidgetDocument
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSectionWidgetDocument extends PressDownloadSectionWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="second_file_id", referencedColumnName="id", nullable=false)
     */
    private $secondFile;


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
    }


    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return PressDownloadSectionWidgetDocument
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\Media $file
     * @return PressDownloadSectionWidgetDocument
     */
    public function setFile(\Base\CoreBundle\Entity\Media $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Base\CoreBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set secondFile
     *
     * @param \Base\CoreBundle\Entity\Media $secondFile
     * @return PressDownloadSectionWidgetDocument
     */
    public function setSecondFile(\Base\CoreBundle\Entity\Media $secondFile)
    {
        $this->secondFile = $secondFile;

        return $this;
    }

    /**
     * Get secondFile
     *
     * @return \Base\CoreBundle\Entity\Media
     */
    public function getSecondFile()
    {
        return $this->secondFile;
    }
}

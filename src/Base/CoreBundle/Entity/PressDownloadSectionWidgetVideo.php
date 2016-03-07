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
class PressDownloadSectionWidgetVideo extends PressDownloadSectionWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id", nullable=false)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="second_file_id", referencedColumnName="id", nullable=true)
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
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return PressDownloadSectionWidgetVideo
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

    /**
     * Set video
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $video
     * @return PressDownloadSectionWidgetVideo
     */
    public function setVideo(\Base\CoreBundle\Entity\MediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return PressDownloadSectionWidgetVideo
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set secondFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $secondFile
     * @return PressDownloadSectionWidgetVideo
     */
    public function setSecondFile(\Application\Sonata\MediaBundle\Entity\Media $secondFile)
    {
        $this->secondFile = $secondFile;

        return $this;
    }

    /**
     * Get secondFile
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getSecondFile()
    {
        return $this->secondFile;
    }
}

<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\Groups;
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
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $file;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $secondFile;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $thirdFile;


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
     * @return PressDownloadSectionWidgetDocument
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return PressDownloadSectionWidgetDocument
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
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
     * @return PressDownloadSectionWidgetDocument
     */
    public function setSecondFile(\Application\Sonata\MediaBundle\Entity\Media $secondFile = null)
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

    /**
     * Set thirdFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $thirdFile
     * @return PressDownloadSectionWidgetDocument
     */
    public function setThirdFile(\Application\Sonata\MediaBundle\Entity\Media $thirdFile = null)
    {
        $this->thirdFile = $thirdFile;

        return $this;
    }

    /**
     * Get thirdFile
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getThirdFile()
    {
        return $this->thirdFile;
    }
}

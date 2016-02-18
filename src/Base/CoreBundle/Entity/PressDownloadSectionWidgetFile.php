<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use Base\CoreBundle\Util\Time;

/**
 * PressDownloadSectionWidgetFile
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressDownloadSectionWidgetFile extends PressDownloadSectionWidget
{

    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
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
     * Set file
     *
     * @param \Base\CoreBundle\Entity\Media $file
     * @return PressDownloadSectionWidgetFile
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
     * @return PressDownloadSectionWidgetFile
     */
    public function setSecondFile(\Base\CoreBundle\Entity\Media $secondFile = null)
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

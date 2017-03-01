<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfPressGraphicalCharterWidget
 * @ORM\Table(name="mdf_press_graphical_charter_widget")
 * @ORM\Entity
 */
class MdfPressGraphicalCharterWidget
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var MediaMdf
     *
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="dispatchDeService")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $image;

    /**
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf")
     */
    protected $epsFile;

    /**
     * @ORM\ManyToOne(targetEntity="MdfPressGraphicalCharter", inversedBy="pressGraphicalCharterWidgets")
     * @ORM\JoinColumn(name="press_graphical_charter_id", referencedColumnName="id")
     */
    protected $pressGraphicalCharter;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return MediaMdf
     */
    public function getEpsFile()
    {
        return $this->epsFile;
    }

    /**
     * @param $epsFile
     *
     * @return $this
     */
    public function setEpsFile($epsFile)
    {
        $this->epsFile = $epsFile;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdf
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPressGraphicalCharter()
    {
        return $this->pressGraphicalCharter;
    }

    /**
     * @param $pressGraphicalCharter
     *
     * @return $this
     */
    public function setPressGraphicalCharter($pressGraphicalCharter)
    {
        $this->pressGraphicalCharter = $pressGraphicalCharter;

        return $this;
    }
}

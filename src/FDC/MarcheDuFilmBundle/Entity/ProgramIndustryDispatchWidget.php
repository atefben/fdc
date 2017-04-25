<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProgramIndustryDispatchWidget
 * @ORM\Table(name="mdf_program_industry_dispatch_widget")
 * @ORM\Entity
 */
class ProgramIndustryDispatchWidget
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
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="ProgramIndustryDispatch", inversedBy="dispatchWidgets")
     * @ORM\JoinColumn(name="program_industry_dispatch_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $programIndustryDispatch;

    /**
     * HomeSliderTop constructor.
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
    public function getProgramIndustryDispatch()
    {
        return $this->programIndustryDispatch;
    }

    /**
     * @param $programIndustryDispatch
     *
     * @return $this
     */
    public function setProgramIndustryDispatch($programIndustryDispatch)
    {
        $this->programIndustryDispatch = $programIndustryDispatch;

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
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}

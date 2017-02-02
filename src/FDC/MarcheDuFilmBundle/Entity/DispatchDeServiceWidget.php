<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use FDC\MarcheDuFilmBundle\Entity\MediaMdf;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DispatchDeServiceWidget
 * @ORM\Table(name="mdf_dispatch_de_service_widget")
 * @ORM\Entity
 */
class DispatchDeServiceWidget
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
     * @ORM\ManyToOne(targetEntity="DispatchDeService", inversedBy="dispatchDeServiceWidgets")
     * @ORM\JoinColumn(name="dispatch_de_service_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $dispatchDeService;

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
    public function getDispatchDeService()
    {
        return $this->dispatchDeService;
    }

    /**
     * @param $dispatchDeService
     *
     * @return $this
     */
    public function setDispatchDeService($dispatchDeService)
    {
        $this->dispatchDeService = $dispatchDeService;

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

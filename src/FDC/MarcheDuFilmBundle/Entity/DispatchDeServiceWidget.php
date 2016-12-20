<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="image", referencedColumnName="id")
     * })
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="DispatchDeService", inversedBy="dispatchDeServiceWidgets")
     * @ORM\JoinColumn(name="dispatch_de_service_id", referencedColumnName="id")
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
     * @return Media
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
}

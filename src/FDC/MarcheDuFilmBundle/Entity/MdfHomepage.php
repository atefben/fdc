<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfHomepage
 * @ORM\Table(name="mdf_homepage")
 * @ORM\Entity
 */
class MdfHomepage
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
     * @ORM\OneToMany(targetEntity="HomeSliderTop", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "validation.home_top_slider_min",
     *      max = "6",
     *      maxMessage = "validation.home_top_slider_max"
     * )
     * @Assert\Valid
     */
    protected $slidersTop;

    /**
     * @ORM\OneToMany(targetEntity="HomeSlider", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $sliders;

    /**
     * @ORM\OneToMany(targetEntity="MdfHomeService", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $services;

    /**
     * @var GalleryMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\GalleryMdf", inversedBy="homepage")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $gallery;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->sliders = new ArrayCollection();
        $this->slidersTop = new ArrayCollection();
        $this->services = new ArrayCollection();
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
     * @return GalleryMdf
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param GalleryMdf $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return mixed
     */
    public function getSlidersTop()
    {
        return $this->slidersTop;
    }

    /**
     * @param HomeSliderTop $homeSliderTop
     *
     * @return $this
     */
    public function addSlidersTop(HomeSliderTop $homeSliderTop)
    {
        if (!$this->slidersTop->contains($homeSliderTop)) {
            $this->slidersTop->add($homeSliderTop);
            $homeSliderTop->setHomepage($this);
        }

        return $this;
    }

    /**
     * @param HomeSliderTop $homeSliderTop
     *
     * @return $this
     */
    public function removeSlidersTop(HomeSliderTop $homeSliderTop)
    {
        if ($this->slidersTop->contains($homeSliderTop)) {
            $this->slidersTop->removeElement($homeSliderTop);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSliders()
    {
        return $this->sliders;
    }

    /**
     * @param HomeSlider $homeSlider
     *
     * @return $this
     */
    public function addSlider(HomeSlider $homeSlider)
    {
        if (!$this->sliders->contains($homeSlider)) {
            $this->sliders->add($homeSlider);
            $homeSlider->setHomepage($this);
        }

        return $this;
    }

    /**
     * @param HomeSlider $homeSlider
     *
     * @return $this
     */
    public function removeSlider(HomeSlider $homeSlider)
    {
        if ($this->sliders->contains($homeSlider)) {
            $this->sliders->removeElement($homeSlider);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param MdfHomeService $homeService
     *
     * @return $this
     */
    public function addService(MdfHomeService $homeService)
    {
        if (!$this->services->contains($homeService)) {
            $this->services->add($homeService);
            $homeService->setHomepage($this);
        }

        return $this;
    }

    /**
     * @param MdfHomeService $homeService
     *
     * @return $this
     */
    public function removeService(MdfHomeService $homeService)
    {
        if ($this->services->contains($homeService)) {
            $this->services->removeElement($homeService);
        }

        return $this;
    }
}

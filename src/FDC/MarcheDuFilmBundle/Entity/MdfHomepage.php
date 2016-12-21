<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;

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
     */
    protected $slidersTop;

    /**
     * @ORM\OneToMany(targetEntity="HomeSlider", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $sliders;

    /**
     * @ORM\OneToMany(targetEntity="MdfHomeContentSlider", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $contentSliders;

    /**
     * @ORM\OneToMany(targetEntity="MdfHomeService", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $services;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->sliders = new ArrayCollection();
        $this->slidersTop = new ArrayCollection();
        $this->contentSliders = new ArrayCollection();
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
    public function getContentSliders()
    {
        return $this->contentSliders;
    }

    /**
     * @param MdfHomeContentSlider $homeContentSlider
     *
     * @return $this
     */
    public function addContentSlider(MdfHomeContentSlider $homeContentSlider)
    {
        if (!$this->contentSliders->contains($homeContentSlider)) {
            $this->contentSliders->add($homeContentSlider);
            $homeContentSlider->setHomepage($this);
        }

        return $this;
    }

    /**
     * @param MdfHomeContentSlider $homeContentSlider
     *
     * @return $this
     */
    public function removeContentSlider(MdfHomeContentSlider $homeContentSlider)
    {
        if ($this->contentSliders->contains($homeContentSlider)) {
            $this->contentSliders->removeElement($homeContentSlider);
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

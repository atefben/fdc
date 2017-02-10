<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Homepage
 * @ORM\Table(name="ccm_homepage")
 * @ORM\Entity
 */
class Homepage
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
     * @ORM\OneToMany(targetEntity="HomepageSlider", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "3",
     *      minMessage = "ccm.validation.homepage.sliders_min",
     *      max = "6",
     *      maxMessage = "ccm.validation.homepage.sliders_max"
     * )
     * @Assert\Valid
     */
    protected $sliders;

    /**
     * @ORM\OneToMany(targetEntity="HomepageSlider", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "3",
     *      minMessage = "ccm.validation.homepage.pushes_min",
     *      max = "9",
     *      maxMessage = "ccm.validation.homepage.pushes_max"
     * )
     * @Assert\Valid
     */
    protected $pushes;

    /**
     * @var ArrayCollection
     */
    protected $translations;


    /**
     * Homepage constructor.
     */
    public function __construct() {
        $this->translations = new ArrayCollection();
        $this->sliders = new ArrayCollection();
        $this->pushes = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Find Translation By Locale.
     *
     * @param $locale
     * @return mixed|null
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }

        return (string) $string;
    }

    /**
     * Get Sliders.
     *
     * @return mixed
     */
    public function getSliders()
    {
        return $this->sliders;
    }

    /**
     * Set sliders.
     *
     * @param mixed $sliders
     */
    public function setSliders($sliders)
    {
        $this->sliders = $sliders;
    }

    /**
     * Add sliders.
     *
     * @param HomepageSlider $slider
     *
     * @return $this
     */
    public function addSlider(HomepageSlider $slider)
    {
        $this->sliders->add($slider);
        $slider->setHomepage($this);

        return $this;
    }

    /**
     * Remove sliders.
     *
     * @param HomepageSlider $slider
     */
    public function removeSlider(HomepageSlider $slider)
    {
        $this->sliders->removeElement($slider);
    }

    /**
     * Get pushes.
     *
     * @return mixed
     */
    public function getPushes()
    {
        return $this->pushes;
    }

    /**
     * Set pushes.
     *
     * @param mixed $pushes
     */
    public function setPushes($pushes)
    {
        $this->pushes = $pushes;
    }

    /**
     * Add push.
     *
     * @param HomepagePush $push
     *
     * @return $this
     */
    public function addPush(HomepagePush $push)
    {
        $this->pushes->add($push);
        $push->setHomepage($this);

        return $this;
    }

    /**
     * Remove push.
     *
     * @param HomepagePush $push
     */
    public function removePush(HomepagePush $push)
    {
        $this->pushes->removeElement($push);
    }
}

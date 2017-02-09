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
     *      minMessage = "validation.ccm_home_slider_min",
     *      max = "6",
     *      maxMessage = "validation.ccm_home_slider_max"
     * )
     * @Assert\Valid
     */
    protected $sliders;

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

        return $this;
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
}

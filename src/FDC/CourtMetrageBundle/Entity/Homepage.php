<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Util\Soif;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\FilmSelectionSection;

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
     * @ORM\OneToMany(targetEntity="HomepagePush", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
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
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\FilmSelectionSection")
     */
    protected $selectionSection;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $courtYear;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $courtIsActive = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $pushIsActive = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $catalogIsActive = false;

    /**
     * @ORM\OneToMany(targetEntity="CatalogPush", mappedBy="homepage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      min = "3",
     *      minMessage = "ccm.validation.homepage.catalog.pushes_min",
     *      max = "5",
     *      maxMessage = "ccm.validation.homepage.catalog.pushes_max"
     * )
     * @Assert\Valid
     */
    protected $catalogPushes;

    /**
     * @var MediaImage
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage", inversedBy="catalogPushes")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $catalogImage;

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
        $this->catalogPushes =  new ArrayCollection();
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

        return $this;
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

    /**
     * Get selectionSection.
     *
     * @return FilmSelectionSection
     */
    public function getSelectionSection()
    {
        return $this->selectionSection;
    }

    /**
     * Set selectionSection.
     *
     * @param FilmSelectionSection $selectionSection
     */
    public function setSelectionSection($selectionSection)
    {
        $this->selectionSection = $selectionSection;

        return $this;
    }

    /**
     * Get CourtIsActive.
     *
     * @return bool
     */
    public function getCourtIsActive()
    {
        return $this->courtIsActive;
    }

    /**
     * Set courtIsActive.
     *
     * @param bool $courtIsActive
     */
    public function setCourtIsActive($courtIsActive)
    {
        $this->courtIsActive = $courtIsActive;

        return $this;
    }

    /**
     * Get courtYear.
     *
     * @return string
     */
    public function getCourtYear()
    {
        return $this->courtYear;
    }

    /**
     * Set courtYear.
     *
     * @param string $courtYear
     */
    public function setCourtYear($courtYear)
    {
        $this->courtYear = $courtYear;

        return $this;
    }

    /**
     * Get pushIsActive.
     *
     * @return bool
     */
    public function getPushIsActive()
    {
        return $this->pushIsActive;
    }

    /**
     * Set pushIsActive.
     *
     * @param bool $pushIsActive
     */
    public function setPushIsActive($pushIsActive)
    {
        $this->pushIsActive = $pushIsActive;
    }

    /**
     * Get catalogIsActive.
     *
     * @return bool
     */
    public function getCatalogIsActive()
    {
        return $this->catalogIsActive;
    }

    /**
     * Set catalogIsActive.
     *
     * @param bool $catalogIsActive
     */
    public function setCatalogIsActive($catalogIsActive)
    {
        $this->catalogIsActive = $catalogIsActive;

        return $this;
    }

    /**
     * Get catalogPushes.
     *
     * @return mixed
     */
    public function getCatalogPushes()
    {
        return $this->catalogPushes;
    }

    /**
     * Set catalogPushes.
     *
     * @param mixed $catalogPushes
     */
    public function setCatalogPushes($catalogPushes)
    {
        $this->catalogPushes = $catalogPushes;

        return $this;
    }

    /**
     * Add catalogPush.
     *
     * @param catalogPush $push
     *
     * @return $this
     */
    public function addCatalogPush(CatalogPush $catalogPush)
    {
        $this->catalogPushes->add($catalogPush);
        $catalogPush->setHomepage($this);

        return $this;
    }

    /**
     * Remove catalogPush.
     *
     * @param CatalogPush $push
     */
    public function removeCatalogPush(CatalogPush $catalogPush)
    {
        $this->catalogPushes->removeElement($catalogPush);
    }

    /**
     * Get catalogImage.
     *
     * @return MediaImage
     */
    public function getCatalogImage()
    {
        return $this->catalogImage;
    }

    /**
     * Set catalogImage.
     *
     * @param MediaImage $catalogImage
     */
    public function setCatalogImage($catalogImage)
    {
        $this->catalogImage = $catalogImage;

        return $this;
    }
}

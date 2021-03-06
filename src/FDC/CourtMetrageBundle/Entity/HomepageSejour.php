<?php

namespace FDC\CourtMetrageBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepageSejour
 * @ORM\Table(name="ccm_homepage_sejour")
 * @ORM\Entity
 */
class HomepageSejour
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
     * @var CcmMediaImage
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", inversedBy="homepageSejoures")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="sejoures")
     * @ORM\JoinColumn(name="homepage_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $homepage;

    /**
     * @ORM\ManyToOne(targetEntity="CcmShortFilmCorner", inversedBy="sejoures")
     * @ORM\JoinColumn(name="short_film_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $shortFilm;

    /**
     * @ORM\ManyToOne(targetEntity="CcmProsPage", inversedBy="sejoures")
     * @ORM\JoinColumn(name="pros_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $prosPage;

    /**
     * @ORM\ManyToOne(targetEntity="CcmProgram", inversedBy="sejoures")
     * @ORM\JoinColumn(name="program_page_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $programPage;

    /**
     * HomepageSejour constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * Get image.
     *
     * @return CcmMediaImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image.
     *
     * @param CcmMediaImage $image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get homepage.
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set homepage.
     *
     * @param mixed $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get Translations.
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set translations
     *
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
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

    /**
     * Get shortFilm.
     *
     * @return mixed
     */
    public function getShortFilm()
    {
        return $this->shortFilm;
    }

    /**
     * Set shortFilm.
     *
     * @param mixed $shortFilm
     */
    public function setShortFilm($shortFilm)
    {
        $this->shortFilm = $shortFilm;

        return $this;
    }

    /**
     * Get prosPage.
     *
     * @return mixed
     */
    public function getProsPage()
    {
        return $this->prosPage;
    }

    /**
     * Set ProsPage.
     *
     * @param mixed $prosPage
     */
    public function setProsPage($prosPage)
    {
        $this->prosPage = $prosPage;
    }

    /**
     * Get prosPage.
     *
     * @return mixed
     */
    public function getProgramPage()
    {
        return $this->programPage;
    }

    /**
     * Set ProsPage.
     *
     * @param CcmProgram $programPage
     * @return true
     */
    public function setProgramPage(CcmProgram$programPage)
    {
        $this->programPage = $programPage;

        return true;
    }
}

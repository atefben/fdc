<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\TranslationByLocale;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
/**
 * Pays
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Country implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;
    use Time;
    use Soif;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show",
     *     "film_show",
     *     "film_selection_section_show"
     * })
     */
    private $iso;

    /**
     * @ORM\OneToMany(targetEntity="FilmAddress", mappedBy="country")
     */
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilmCountry", mappedBy="country")
     */
    private $countryFilms;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAtelierCountry", mappedBy="country")
     */
    private $countryFilmAteliers;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmLanguage", mappedBy="country")
     */
    private $languageFilms;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAtelierLanguage", mappedBy="country")
     */
    private $languageFilmAteliers;

    /**
     * @var ArrayCollection
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "trailer_list",
     *     "trailer_show",
     *     "award_list",
     *     "award_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_show",
     *     "film_selection_section_show"
     * })
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->countryFilms = new ArrayCollection();
        $this->countryFilmAteliers = new ArrayCollection();
        $this->languageFilms = new ArrayCollection();
        $this->languageFilmAteliers = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }
    
    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = (string)$this->getISO();
        }

        return $string;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Country
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set iso
     *
     * @param string $iso
     * @return Country
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string 
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Add addresses
     *
     * @param \Base\CoreBundle\Entity\FilmAddress $addresses
     * @return Country
     */
    public function addAddress(\Base\CoreBundle\Entity\FilmAddress $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \Base\CoreBundle\Entity\FilmAddress $addresses
     */
    public function removeAddress(\Base\CoreBundle\Entity\FilmAddress $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add countryFilms
     *
     * @param \Base\CoreBundle\Entity\FilmFilmCountry $countryFilms
     * @return Country
     */
    public function addCountryFilm(\Base\CoreBundle\Entity\FilmFilmCountry $countryFilms)
    {
        $this->countryFilms[] = $countryFilms;

        return $this;
    }

    /**
     * Remove countryFilms
     *
     * @param \Base\CoreBundle\Entity\FilmFilmCountry $countryFilms
     */
    public function removeCountryFilm(\Base\CoreBundle\Entity\FilmFilmCountry $countryFilms)
    {
        $this->countryFilms->removeElement($countryFilms);
    }

    /**
     * Get countryFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountryFilms()
    {
        return $this->countryFilms;
    }

    /**
     * Add countryFilmAteliers
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers
     * @return Country
     */
    public function addCountryFilmAtelier(\Base\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers)
    {
        $this->countryFilmAteliers[] = $countryFilmAteliers;

        return $this;
    }

    /**
     * Remove countryFilmAteliers
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers
     */
    public function removeCountryFilmAtelier(\Base\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers)
    {
        $this->countryFilmAteliers->removeElement($countryFilmAteliers);
    }

    /**
     * Get countryFilmAteliers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountryFilmAteliers()
    {
        return $this->countryFilmAteliers;
    }

    /**
     * Add languageFilms
     *
     * @param \Base\CoreBundle\Entity\FilmLanguage $languageFilms
     * @return Country
     */
    public function addLanguageFilm(\Base\CoreBundle\Entity\FilmLanguage $languageFilms)
    {
        $this->languageFilms[] = $languageFilms;

        return $this;
    }

    /**
     * Remove languageFilms
     *
     * @param \Base\CoreBundle\Entity\FilmLanguage $languageFilms
     */
    public function removeLanguageFilm(\Base\CoreBundle\Entity\FilmLanguage $languageFilms)
    {
        $this->languageFilms->removeElement($languageFilms);
    }

    /**
     * Get languageFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguageFilms()
    {
        return $this->languageFilms;
    }

    /**
     * Add languageFilmAteliers
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers
     * @return Country
     */
    public function addLanguageFilmAtelier(\Base\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers)
    {
        $this->languageFilmAteliers[] = $languageFilmAteliers;

        return $this;
    }

    /**
     * Remove languageFilmAteliers
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers
     */
    public function removeLanguageFilmAtelier(\Base\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers)
    {
        $this->languageFilmAteliers->removeElement($languageFilmAteliers);
    }

    /**
     * Get languageFilmAteliers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguageFilmAteliers()
    {
        return $this->languageFilmAteliers;
    }
}

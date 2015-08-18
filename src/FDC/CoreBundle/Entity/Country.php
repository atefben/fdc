<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Translation;
use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * Pays
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Country
{
    use Translatable;
    use Translation;
    use Time;
    use Soif;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3)
     */
    private $iso;

    /**
     * @ORM\OneToMany(targetEntity="FilmAddress", mappedBy="country")
     */
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="subtitleLanguage")
     */
    private $subtitleLanguageFilms;

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
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->subtitleLanguageFilms = new ArrayCollection();
        $this->countryFilms = new ArrayCollection();
        $this->countryFilmAteliers = new ArrayCollection();
        $this->languageFilms = new ArrayCollection();
        $this->languageFilmAteliers = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
     * @param \FDC\CoreBundle\Entity\FilmAddress $addresses
     * @return Country
     */
    public function addAddress(\FDC\CoreBundle\Entity\FilmAddress $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $addresses
     */
    public function removeAddress(\FDC\CoreBundle\Entity\FilmAddress $addresses)
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
     * Add subtitleLanguageFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $subtitleLanguageFilms
     * @return Country
     */
    public function addSubtitleLanguageFilm(\FDC\CoreBundle\Entity\FilmFilm $subtitleLanguageFilms)
    {
        $this->subtitleLanguageFilms[] = $subtitleLanguageFilms;

        return $this;
    }

    /**
     * Remove subtitleLanguageFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $subtitleLanguageFilms
     */
    public function removeSubtitleLanguageFilm(\FDC\CoreBundle\Entity\FilmFilm $subtitleLanguageFilms)
    {
        $this->subtitleLanguageFilms->removeElement($subtitleLanguageFilms);
    }

    /**
     * Get subtitleLanguageFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubtitleLanguageFilms()
    {
        return $this->subtitleLanguageFilms;
    }

    /**
     * Add countryFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmCountry $countryFilms
     * @return Country
     */
    public function addCountryFilm(\FDC\CoreBundle\Entity\FilmFilmCountry $countryFilms)
    {
        $this->countryFilms[] = $countryFilms;

        return $this;
    }

    /**
     * Remove countryFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmCountry $countryFilms
     */
    public function removeCountryFilm(\FDC\CoreBundle\Entity\FilmFilmCountry $countryFilms)
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
     * @param \FDC\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers
     * @return Country
     */
    public function addCountryFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers)
    {
        $this->countryFilmAteliers[] = $countryFilmAteliers;

        return $this;
    }

    /**
     * Remove countryFilmAteliers
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers
     */
    public function removeCountryFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelierCountry $countryFilmAteliers)
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
     * @param \FDC\CoreBundle\Entity\FilmLanguage $languageFilms
     * @return Country
     */
    public function addLanguageFilm(\FDC\CoreBundle\Entity\FilmLanguage $languageFilms)
    {
        $this->languageFilms[] = $languageFilms;

        return $this;
    }

    /**
     * Remove languageFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmLanguage $languageFilms
     */
    public function removeLanguageFilm(\FDC\CoreBundle\Entity\FilmLanguage $languageFilms)
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
     * @param \FDC\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers
     * @return Country
     */
    public function addLanguageFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers)
    {
        $this->languageFilmAteliers[] = $languageFilmAteliers;

        return $this;
    }

    /**
     * Remove languageFilmAteliers
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers
     */
    public function removeLanguageFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelierLanguage $languageFilmAteliers)
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

<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Country
{
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
     * @var string
     *
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $nameFR;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $nameEN;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $languageFR;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $languageEN;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="FilmAddress", mappedBy="country")
     */
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="subtitleLanguage")
     */
    private $subtitleLanguageFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmCountry", mappedBy="country")
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
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subtitleLanguageFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countryFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countryFilmAteliers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languageFilms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languageFilmAteliers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nameFR
     *
     * @param string $nameFR
     * @return Country
     */
    public function setNameFR($nameFR)
    {
        $this->nameFR = $nameFR;

        return $this;
    }

    /**
     * Get nameFR
     *
     * @return string 
     */
    public function getNameFR()
    {
        return $this->nameFR;
    }

    /**
     * Set nameEN
     *
     * @param string $nameEN
     * @return Country
     */
    public function setNameEN($nameEN)
    {
        $this->nameEN = $nameEN;

        return $this;
    }

    /**
     * Get nameEN
     *
     * @return string 
     */
    public function getNameEN()
    {
        return $this->nameEN;
    }

    /**
     * Set languageFR
     *
     * @param string $languageFR
     * @return Country
     */
    public function setLanguageFR($languageFR)
    {
        $this->languageFR = $languageFR;

        return $this;
    }

    /**
     * Get languageFR
     *
     * @return string 
     */
    public function getLanguageFR()
    {
        return $this->languageFR;
    }

    /**
     * Set languageEN
     *
     * @param string $languageEN
     * @return Country
     */
    public function setLanguageEN($languageEN)
    {
        $this->languageEN = $languageEN;

        return $this;
    }

    /**
     * Get languageEN
     *
     * @return string 
     */
    public function getLanguageEN()
    {
        return $this->languageEN;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Country
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Country
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * @param \FDC\CoreBundle\Entity\FilmCountry $countryFilms
     * @return Country
     */
    public function addCountryFilm(\FDC\CoreBundle\Entity\FilmCountry $countryFilms)
    {
        $this->countryFilms[] = $countryFilms;

        return $this;
    }

    /**
     * Remove countryFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmCountry $countryFilms
     */
    public function removeCountryFilm(\FDC\CoreBundle\Entity\FilmCountry $countryFilms)
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

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
     * @ORM\Column(name="ID", type="integer", nullable=false)
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
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="subtitleLanguage")
     */
    private $subtitleLanguagesFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmCountry", mappedBy="country")
     */
    private $filmsCountries;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAtelierCountry", mappedBy="country")
     */
    private $filmsAtelierCountries;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmLanguage", mappedBy="country")
     */
    private $filmsLanguages;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmAtelierLanguage", mappedBy="country")
     */
    private $filmsAtelierLanguages;
}

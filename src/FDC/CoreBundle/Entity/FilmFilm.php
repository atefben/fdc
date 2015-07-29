<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmFilm
 *
 * @ORM\Table(indexes={@ORM\Index(name="production_address_id", columns={"production_address_id"}), @ORM\Index(name="distribution_address_id", columns={"distribution_address_id"}), @ORM\Index(name="press_address_id", columns={"press_address_id"}), @ORM\Index(name="press_internat_address_id", columns={"press_internat_address_id"}), @ORM\Index(name="event_address_id", columns={"event_address_id"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="festival_year", columns={"festival_year"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFilm
{
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, length=36)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVO;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVF;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVA;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     */
    private $courtlong;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=2, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $filmFirst;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $worldFirst;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $productionYear;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $section;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVa;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogueVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogueVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $previousEvent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $exploitationCountries;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internetDisplayed;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $restaurantOwner;

    /**
     * @var string
     *
     * @ORM\Column(length=40, nullable=true)
     */
    private $restorationType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $noDialog;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $color;

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
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $gala;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subSelectionVF;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subSelectionVA;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="subtitleLanguagesFilms")
     */
    private $subtitleLanguage;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="productionFilms")
     */
    private $productionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="distributionFilms")
     */
    private $distributionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="pressFilms")
     */
    private $pressAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="pressInternatFilms")
     */
    private $pressInternatAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="eventFilms")
     */
    private $eventAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="directorFilms")
     */
    private $directorAddress;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmCategory", inversedBy="films")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmGeneric", mappedBy="film")
     */
    private $generics;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="film")
     */
    private $awards;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="film")
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="FilmMinorProduction", mappedBy="film")
     */
    private $minorProductions;

    /**
     * @ORM\OneToMany(targetEntity="FilmCountry", mappedBy="film")
     */
    private $countries;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAddressSchool", mappedBy="film")
     */
    private $schoolAddresses;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmLanguage", mappedBy="film")
     */
    private $languages;

    /**
     * @ORM\ManyToMany(targetEntity="FilmProjection", inversedBy="films")
     */
    private $projections;
    
    /**
     * @var FilmFilmTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmFilmTranslation", mappedBy="film")
     */
    private $translations;

}

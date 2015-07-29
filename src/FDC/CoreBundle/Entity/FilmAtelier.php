<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAtelier
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_year_title_vo", columns={"festival_year", "title_vo"}),@ORM\Index(name="internet", columns={"internet"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelier
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned" = true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titleVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
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
    private $premierFilm;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $premiereMondiale;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $productionYear;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmCategory", inversedBy="filmAteliers")
     */
    private $category;

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
    private $synopsisVf2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVf3;

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
    private $synopsisVa2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsisVa3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog1Vf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogue2Vf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialogue3Vf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog1Va;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog2Va;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $dialog3Va;

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
    private $exploitationCountry;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internetDiffusion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cinandoUrl;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $productionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $distributionAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $pressFrAdress;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $addressPressInternatId;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $eventAddress;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmAddress")
     */
    private $directorAddress;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $subtitleLanguage;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $restaurantOwner;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $gala;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $transitaireDepart;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $transitaireArrivee;
    
     /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $productionInfos;

    /**
     * @ORM\OneToMany(targetEntity="FilmAtelierMinorProduction", mappedBy="film")
     */
    private $minorProductions;

    /**
     * @var FilmAtelierGeneric
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierGeneric", mappedBy="filmAtelier")
     */
    private $filmAtelierGenerics;

    /**
     * @var FilmPhoto
     *
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="filmAtelier")
     */
    private $photos;
    
    /**
     * @var FilmCountry
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierCountry", mappedBy="film")
     */
    private $countries;
    
    /**
     * @var FilmCountry
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierLanguage", mappedBy="film")
     */
    private $languages;
    
    /**
     * @var FilmAtelierTranslation
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierTranslation", mappedBy="film")
     */
    private $translations;
}

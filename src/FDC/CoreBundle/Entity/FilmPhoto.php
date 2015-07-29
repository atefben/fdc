<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmPhoto
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="generic_id", columns={"generic_id"}), @ORM\Index(name="jury_id", columns={"jury_id"}), @ORM\Index(name="film_id", columns={"film_id"}), @ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="title_vf", columns={"title_vf"}), @ORM\Index(name="title_va", columns={"title_va"}), @ORM\Index(name="type", columns={"type"}), @ORM\Index(name="file", columns={"file"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmPhoto
{
    use Time;

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
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $noteVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $noteVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $copyright;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $credits;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $type;

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
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $titleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $titleVa;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $photoTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="photos")
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="photos")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="FilmGeneric", inversedBy="photos")
     */
    private $generic;

    /**
     * @ORM\ManyToOne(targetEntity="FilmJury", inversedBy="photos")
     */
    private $jury;

    /**
     * @ORM\ManyToOne(targetEntity="FilmEvent", inversedBy="photos")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="FilmEvent", inversedBy="photos")
     */
    private $poster;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAtelierGeneric", inversedBy="photos")
     */
    private $filmAtelierpGeneric;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="photos")
     */
    private $filmAtelier;

    /**
     * @ORM\ManyToOne(targetEntity="CinefPerson", inversedBy="photos")
     */
    private $cinefPerson;
}
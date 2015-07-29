<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAddress
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAddress
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

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
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="adresses")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $contactsOptionals;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmPerson", mappedBy="function")
     */
    private $persons;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="directorAddress")
     */
    private $directorFilms;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAddressSchool", mappedBy="address")
     */
    private $schoolsFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="eventAddress")
     */
    private $eventFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="pressInternatAddress")
     */
    private $pressInternatFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="pressFilms")
     */
    private $pressAddress;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="distributionFilms")
     */
    private $distributionAddress;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="productionFilms")
     */
    private $productionAddress;
}

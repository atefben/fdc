<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmJury
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="CLEDETRI", columns={"CLEDETRI"}), @ORM\Index(name="updated_at", columns={"updated_at"}) })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmJury
{
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="CLEDETRI", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF", type="text", nullable=true)
     */
    private $bioFilmVf;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA", type="text", nullable=true)
     */
    private $bioFilmVa;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF2", type="text", nullable=true)
     */
    private $bioFilmVf2;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA2", type="text", nullable=true)
     */
    private $bioFilmVa2;

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
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="juries")
     */
    private $person;

    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryType", inversedBy="juries")
     */
    private $type;
    
    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryFunction", inversedBy="juries")
     */
    private $function;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="jury")
     */
    private $photos;
}
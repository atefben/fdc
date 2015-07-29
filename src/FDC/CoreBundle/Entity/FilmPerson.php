<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmPerson
 *
 * @ORM\Table(indexes={@ORM\Index(name="lastname_firstname", columns={"lastname", "firstname"}), @ORM\Index(name="FILM_PERSONNE_FI_1", columns={"nationality"}), @ORM\Index(name="FILM_PERSONNE_FI_2", columns={"nationality2"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="INTERNET", columns={"internet"}), @ORM\Index(name="pm_profession_va", columns={"job_va"}), @ORM\Index(name="pm_profession_vf", columns={"job_vf"})})
 * @ORM\Entity(repositoryClass="FDC\CoreBundle\Repository\FilmFifPersonneRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmPerson
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
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $civility;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $nationality2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $jobVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $jobVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $qualification;

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
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $birthLocation;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $bioFilmVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $bioFilmVa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $inversionName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="persons")
     */
    private $function;
    
    /**
     * @var FilmAtelierGeneric
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierGeneric", mappedBy="filmAtelier")
     */
    private $filmAtelierGenerics;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmGeneric", mappedBy="person")
     */
    private $filmGenerics;

    /**
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="person")
     */
    private $juries;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="person")
     */
    private $awards;

    /**
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="person")
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="persons")
     */
    private $address;
}

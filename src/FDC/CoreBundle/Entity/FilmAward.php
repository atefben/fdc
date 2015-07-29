<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAward
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="prize_id", columns={"prize_id"}), @ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="importance", columns={"importance"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity(repositoryClass="FDC\CoreBundle\Repository\FilmAwardRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmAward
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    private $importance;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $exAequo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $unanimity;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

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
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="awards")
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="awards")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPrice", inversedBy="awards")
     */
    private $prize;
}

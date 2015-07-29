<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmProjection
 *
 * @ORM\Table(indexes={@ORM\Index(name="displayed_at", columns={"displayed_at"}), @ORM\Index(name="room_id", columns={"room_id"}), @ORM\Index(name="section_programming_vf", columns={"section_programming_vf"}), @ORM\Index(name="section_programming_va", columns={"section_programming_va"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjection
{
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     */
    private $film;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=2, scale=0, nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $dayCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $scheduleTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $locked;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $modelId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $controlinfo;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, scale=0, nullable=true)
     */
    private $point;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, scale=0, nullable=true)
     */
    private $waitingList;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $teamPresence;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $displayedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmRoom", inversedBy="projections")
     */
    private $room;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $projType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $warning;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $special;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $given;

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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $agenda;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $sectionProgrammingVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $sectionProgrammingVa;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmFilm", mappedBy="projections")
     */
    private $films;

}

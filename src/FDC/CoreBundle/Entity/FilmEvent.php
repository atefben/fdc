<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmEvent
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="event_type_id", columns={"event_type_id"}), @ORM\Index(name="order", columns={"order"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="pm_dateevent", columns={"starts_at", "order"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmEvent
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startsAt;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $personId;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmEventType")
     */
    private $eventType;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf4;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa4;

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
     * @var decimal
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="event")
     */
    private $photos;
}

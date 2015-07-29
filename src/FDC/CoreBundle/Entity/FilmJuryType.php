<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmJuryType
 *
 * @ORM\Table(indexes={@ORM\Index(name="order", columns={"order"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmJuryType
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $juryTypeVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $juryTypeVa;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $order;

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
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="type")
     */
    private $photos;
}

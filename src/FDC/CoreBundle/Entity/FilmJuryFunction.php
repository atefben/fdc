<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmJuryFonction
 *
 * @ORM\Table(indexes={@ORM\Index(name="function_vf", columns={"function_vf"}), @ORM\Index(name="function_va", columns={"function_va"}), @ORM\Index(name="order", columns={"order"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmJuryFunction
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
    private $functionVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $functionVa;

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
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="function")
     */
    private $photos;
}

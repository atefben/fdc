<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmFonction
 *
 * @ORM\Table(indexes={@ORM\Index(name="function_vf", columns={"function_vf"}), @ORM\Index(name="function_va", columns={"function_va"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="order", columns={"order"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmFunction
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $functionVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
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
     * @ORM\OneToMany(targetEntity="FilmPerson", mappedBy="address")
     */
    private $persons;
}

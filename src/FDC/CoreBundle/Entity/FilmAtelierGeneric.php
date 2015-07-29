<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * FilmAtelierGeneric
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="id_order", columns={"id", "order"}), @ORM\Index(name="order", columns={"order"}), @ORM\Index(name="function_id", columns={"function_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierGeneric
{
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
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $roleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $roleVa;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    private $order;

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
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="filmAtelierGenerics")
     */
    private $function;

    /**
     * @var FilmPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="filmAtelierGenerics")
     */
    private $person;

    /**
     * @var FilmAtelier
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="filmAtelierGenerics")
     */
    private $filmAtelier;

    /**
     * @var FilmPhoto
     *
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="filmAtelierGeneric")
     */
    private $photos;
}

<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmGeneric
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="film_id", columns={"film_id"}), @ORM\Index(name="function_vf", columns={"function_vf"}), @ORM\Index(name="function_va", columns={"function_va"}), @ORM\Index(name="role_vf", columns={"role_vf"}), @ORM\Index(name="role_va", columns={"role_va"}), @ORM\Index(name="order", columns={"order"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="function_id", columns={"function_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmGeneric
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
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="filmGenerics")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="generics")
     */
    private $film;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roleVare;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roleVchi;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roleVesp;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roleVjpn;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roleVprt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roleVrus;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $functionId;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="generic")
     */
    private $medias;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set functionVf
     *
     * @param string $functionVf
     * @return FilmGeneric
     */
    public function setFunctionVf($functionVf)
    {
        $this->functionVf = $functionVf;

        return $this;
    }

    /**
     * Get functionVf
     *
     * @return string 
     */
    public function getFunctionVf()
    {
        return $this->functionVf;
    }

    /**
     * Set functionVa
     *
     * @param string $functionVa
     * @return FilmGeneric
     */
    public function setFunctionVa($functionVa)
    {
        $this->functionVa = $functionVa;

        return $this;
    }

    /**
     * Get functionVa
     *
     * @return string 
     */
    public function getFunctionVa()
    {
        return $this->functionVa;
    }

    /**
     * Set roleVf
     *
     * @param string $roleVf
     * @return FilmGeneric
     */
    public function setRoleVf($roleVf)
    {
        $this->roleVf = $roleVf;

        return $this;
    }

    /**
     * Get roleVf
     *
     * @return string 
     */
    public function getRoleVf()
    {
        return $this->roleVf;
    }

    /**
     * Set roleVa
     *
     * @param string $roleVa
     * @return FilmGeneric
     */
    public function setRoleVa($roleVa)
    {
        $this->roleVa = $roleVa;

        return $this;
    }

    /**
     * Get roleVa
     *
     * @return string 
     */
    public function getRoleVa()
    {
        return $this->roleVa;
    }

    /**
     * Set roleVare
     *
     * @param string $roleVare
     * @return FilmGeneric
     */
    public function setRoleVare($roleVare)
    {
        $this->roleVare = $roleVare;

        return $this;
    }

    /**
     * Get roleVare
     *
     * @return string 
     */
    public function getRoleVare()
    {
        return $this->roleVare;
    }

    /**
     * Set roleVchi
     *
     * @param string $roleVchi
     * @return FilmGeneric
     */
    public function setRoleVchi($roleVchi)
    {
        $this->roleVchi = $roleVchi;

        return $this;
    }

    /**
     * Get roleVchi
     *
     * @return string 
     */
    public function getRoleVchi()
    {
        return $this->roleVchi;
    }

    /**
     * Set roleVesp
     *
     * @param string $roleVesp
     * @return FilmGeneric
     */
    public function setRoleVesp($roleVesp)
    {
        $this->roleVesp = $roleVesp;

        return $this;
    }

    /**
     * Get roleVesp
     *
     * @return string 
     */
    public function getRoleVesp()
    {
        return $this->roleVesp;
    }

    /**
     * Set roleVjpn
     *
     * @param string $roleVjpn
     * @return FilmGeneric
     */
    public function setRoleVjpn($roleVjpn)
    {
        $this->roleVjpn = $roleVjpn;

        return $this;
    }

    /**
     * Get roleVjpn
     *
     * @return string 
     */
    public function getRoleVjpn()
    {
        return $this->roleVjpn;
    }

    /**
     * Set roleVprt
     *
     * @param string $roleVprt
     * @return FilmGeneric
     */
    public function setRoleVprt($roleVprt)
    {
        $this->roleVprt = $roleVprt;

        return $this;
    }

    /**
     * Get roleVprt
     *
     * @return string 
     */
    public function getRoleVprt()
    {
        return $this->roleVprt;
    }

    /**
     * Set roleVrus
     *
     * @param string $roleVrus
     * @return FilmGeneric
     */
    public function setRoleVrus($roleVrus)
    {
        $this->roleVrus = $roleVrus;

        return $this;
    }

    /**
     * Get roleVrus
     *
     * @return string 
     */
    public function getRoleVrus()
    {
        return $this->roleVrus;
    }

    /**
     * Set order
     *
     * @param string $order
     * @return FilmGeneric
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return string 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmGeneric
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return FilmGeneric
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set functionId
     *
     * @param integer $functionId
     * @return FilmGeneric
     */
    public function setFunctionId($functionId)
    {
        $this->functionId = $functionId;

        return $this;
    }

    /**
     * Get functionId
     *
     * @return integer 
     */
    public function getFunctionId()
    {
        return $this->functionId;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmGeneric
     */
    public function setPerson(\FDC\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \FDC\CoreBundle\Entity\FilmPerson 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmGeneric
     */
    public function setFilm(\FDC\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \FDC\CoreBundle\Entity\FilmFilm 
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        // Add your code here
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmGeneric
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}

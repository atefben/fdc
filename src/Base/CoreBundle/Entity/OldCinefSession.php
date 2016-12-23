<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCinefSession
 *
 * @ORM\Table(name="old_CINEF_SESSION")
 * @ORM\Entity
 */
class OldCinefSession
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDSESSION", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idsession;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="datetime", nullable=true)
     */
    protected $datemodification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEDEBUT", type="datetime", nullable=true)
     */
    protected $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEFIN", type="datetime", nullable=true)
     */
    protected $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="SAISON", type="string", length=60, nullable=true)
     */
    protected $saison;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO", type="string", length=4, nullable=true)
     */
    protected $numero;



    /**
     * Get idsession
     *
     * @return string 
     */
    public function getIdsession()
    {
        return $this->idsession;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return OldCinefSession
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime 
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return OldCinefSession
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return OldCinefSession
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set saison
     *
     * @param string $saison
     * @return OldCinefSession
     */
    public function setSaison($saison)
    {
        $this->saison = $saison;

        return $this;
    }

    /**
     * Get saison
     *
     * @return string 
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return OldCinefSession
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }
}

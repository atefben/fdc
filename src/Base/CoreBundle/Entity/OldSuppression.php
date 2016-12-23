<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSuppression
 *
 * @ORM\Table(name="old_suppression", indexes={@ORM\Index(name="DATESUPPRESSION", columns={"DATESUPPRESSION"})})
 * @ORM\Entity
 */
class OldSuppression
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDSUPPRESSION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idsuppression;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMTABLE", type="string", length=20, nullable=true)
     */
    protected $nomtable;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMCHAMP1", type="string", length=20, nullable=true)
     */
    protected $nomchamp1;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDCLE1", type="integer", nullable=true)
     */
    protected $idcle1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATESUPPRESSION", type="datetime", nullable=true)
     */
    protected $datesuppression;



    /**
     * Get idsuppression
     *
     * @return integer 
     */
    public function getIdsuppression()
    {
        return $this->idsuppression;
    }

    /**
     * Set nomtable
     *
     * @param string $nomtable
     * @return OldSuppression
     */
    public function setNomtable($nomtable)
    {
        $this->nomtable = $nomtable;

        return $this;
    }

    /**
     * Get nomtable
     *
     * @return string 
     */
    public function getNomtable()
    {
        return $this->nomtable;
    }

    /**
     * Set nomchamp1
     *
     * @param string $nomchamp1
     * @return OldSuppression
     */
    public function setNomchamp1($nomchamp1)
    {
        $this->nomchamp1 = $nomchamp1;

        return $this;
    }

    /**
     * Get nomchamp1
     *
     * @return string 
     */
    public function getNomchamp1()
    {
        return $this->nomchamp1;
    }

    /**
     * Set idcle1
     *
     * @param integer $idcle1
     * @return OldSuppression
     */
    public function setIdcle1($idcle1)
    {
        $this->idcle1 = $idcle1;

        return $this;
    }

    /**
     * Get idcle1
     *
     * @return integer 
     */
    public function getIdcle1()
    {
        return $this->idcle1;
    }

    /**
     * Set datesuppression
     *
     * @param \DateTime $datesuppression
     * @return OldSuppression
     */
    public function setDatesuppression($datesuppression)
    {
        $this->datesuppression = $datesuppression;

        return $this;
    }

    /**
     * Get datesuppression
     *
     * @return \DateTime 
     */
    public function getDatesuppression()
    {
        return $this->datesuppression;
    }
}

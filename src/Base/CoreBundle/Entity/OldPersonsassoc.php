<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldPersonsassoc
 *
 * @ORM\Table(name="old_PersonsAssoc")
 * @ORM\Entity
 */
class OldPersonsassoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idsoif", type="integer", nullable=false)
     */
    protected $idsoif;

    /**
     * @var integer
     *
     * @ORM\Column(name="idselfkit", type="integer", nullable=false)
     */
    protected $idselfkit;



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
     * Set idsoif
     *
     * @param integer $idsoif
     * @return OldPersonsassoc
     */
    public function setIdsoif($idsoif)
    {
        $this->idsoif = $idsoif;

        return $this;
    }

    /**
     * Get idsoif
     *
     * @return integer 
     */
    public function getIdsoif()
    {
        return $this->idsoif;
    }

    /**
     * Set idselfkit
     *
     * @param integer $idselfkit
     * @return OldPersonsassoc
     */
    public function setIdselfkit($idselfkit)
    {
        $this->idselfkit = $idselfkit;

        return $this;
    }

    /**
     * Get idselfkit
     *
     * @return integer 
     */
    public function getIdselfkit()
    {
        return $this->idselfkit;
    }
}

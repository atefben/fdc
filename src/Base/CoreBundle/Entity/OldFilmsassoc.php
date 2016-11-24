<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmsassoc
 *
 * @ORM\Table(name="old_FilmsAssoc")
 * @ORM\Entity
 */
class OldFilmsassoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idsoif", type="string", length=36, nullable=false)
     */
    private $idsoif;

    /**
     * @var integer
     *
     * @ORM\Column(name="idselfkit", type="integer", nullable=false)
     */
    private $idselfkit;



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
     * @param string $idsoif
     * @return OldFilmsassoc
     */
    public function setIdsoif($idsoif)
    {
        $this->idsoif = $idsoif;

        return $this;
    }

    /**
     * Get idsoif
     *
     * @return string 
     */
    public function getIdsoif()
    {
        return $this->idsoif;
    }

    /**
     * Set idselfkit
     *
     * @param integer $idselfkit
     * @return OldFilmsassoc
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

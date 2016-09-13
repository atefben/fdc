<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmAuxPhoto
 *
 * @ORM\Table(name="old_FILM_AUX_PHOTO")
 * @ORM\Entity
 */
class OldFilmAuxPhoto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="IDSOIF", type="string", length=60, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsoif;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldFilmAuxPhoto
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Get idsoif
     *
     * @return string 
     */
    public function getIdsoif()
    {
        return $this->idsoif;
    }
}

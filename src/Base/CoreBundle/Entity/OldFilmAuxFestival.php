<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmAuxFestival
 *
 * @ORM\Table(name="old_FILM_AUX_FESTIVAL")
 * @ORM\Entity
 */
class OldFilmAuxFestival
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=true)
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDSOIF", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idsoif;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldFilmAuxFestival
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
     * @return integer 
     */
    public function getIdsoif()
    {
        return $this->idsoif;
    }
}

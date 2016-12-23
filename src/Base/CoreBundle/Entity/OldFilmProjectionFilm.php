<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmProjectionFilm
 *
 * @ORM\Table(name="old_FILM_PROJECTION_FILM")
 * @ORM\Entity
 */
class OldFilmProjectionFilm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPROJECTION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $idprojection;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $idfilm;



    /**
     * Set idprojection
     *
     * @param integer $idprojection
     * @return OldFilmProjectionFilm
     */
    public function setIdprojection($idprojection)
    {
        $this->idprojection = $idprojection;

        return $this;
    }

    /**
     * Get idprojection
     *
     * @return integer 
     */
    public function getIdprojection()
    {
        return $this->idprojection;
    }

    /**
     * Set idfilm
     *
     * @param string $idfilm
     * @return OldFilmProjectionFilm
     */
    public function setIdfilm($idfilm)
    {
        $this->idfilm = $idfilm;

        return $this;
    }

    /**
     * Get idfilm
     *
     * @return string 
     */
    public function getIdfilm()
    {
        return $this->idfilm;
    }
}

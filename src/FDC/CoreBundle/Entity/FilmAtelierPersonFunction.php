<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmAtelierPersonFunction
 *
 * @ORM\Table(
 *  uniqueConstraints={@ORM\UniqueConstraint(columns={
 *      "function_id", "film_atelier_id"
 *  })})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"function", "filmAtelier"})
 */
class FilmAtelierPersonFunction
{
    use Time;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", cascade={"persist"})
     */
    private $function;

    /**
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelierPerson", inversedBy="functions", cascade={"persist"})
     * @ORM\JoinColumn(name="film_atelier_id", referencedColumnName="id", nullable=false)
     */
    private $filmAtelier;

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
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmFunction $function
     * @return FilmAtelierPersonFunction
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmFunction 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set filmAtelier
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierPerson $filmAtelier
     * @return FilmAtelierPersonFunction
     */
    public function setFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelierPerson $filmAtelier)
    {
        $this->filmAtelier = $filmAtelier;

        return $this;
    }

    /**
     * Get filmAtelier
     *
     * @return \FDC\CoreBundle\Entity\FilmAtelierPerson 
     */
    public function getFilmAtelier()
    {
        return $this->filmAtelier;
    }
}

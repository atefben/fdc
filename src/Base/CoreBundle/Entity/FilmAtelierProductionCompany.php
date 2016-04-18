<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FilmAtelierProductionCompany
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierProductionCompany
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
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;
    
    /**
     * @var FilmAtelierProductionCompanyAddress
     *
     * @ORM\OneToOne(targetEntity="FilmAtelierProductionCompanyAddress", cascade={"persist"})
     */
    private $address;
    
    /**
     * @var FilmAtelier
     *
     * @ORM\OneToMany(targetEntity="FilmAtelier", mappedBy="productionCompany")
     */
    private $filmAtelier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filmAtelier = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return FilmAtelierProductionCompany
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierProductionCompanyAddress $address
     * @return FilmAtelierProductionCompany
     */
    public function setAddress(\Base\CoreBundle\Entity\FilmAtelierProductionCompanyAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Base\CoreBundle\Entity\FilmAtelierProductionCompanyAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add filmAtelier
     *
     * @param \Base\CoreBundle\Entity\FilmAtelier $filmAtelier
     * @return FilmAtelierProductionCompany
     */
    public function addFilmAtelier(\Base\CoreBundle\Entity\FilmAtelier $filmAtelier)
    {
        $this->filmAtelier[] = $filmAtelier;

        return $this;
    }

    /**
     * Remove filmAtelier
     *
     * @param \Base\CoreBundle\Entity\FilmAtelier $filmAtelier
     */
    public function removeFilmAtelier(\Base\CoreBundle\Entity\FilmAtelier $filmAtelier)
    {
        $this->filmAtelier->removeElement($filmAtelier);
    }

    /**
     * Get filmAtelier
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmAtelier()
    {
        return $this->filmAtelier;
    }
}

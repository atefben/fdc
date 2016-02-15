<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsNewsAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageWebTvLiveFilmFilmAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var FDCPageWebTvLive
     *
     * @ORM\ManyToOne(targetEntity="FDCPageWebTvLive", inversedBy="associatedFilmFilms")
     */
    protected $FDCPageWebTvLive;
    
     /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     */
    protected $association;
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }
        
        return $string;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set FDCPageWebTvLive
     *
     * @param \Base\CoreBundle\Entity\FDCPageWebTvLive $FDCPageWebTvLive
     * @return FDCPageWebTvLiveFilmFilmAssociated
     */
    public function setFDCPageWebTvLive(\Base\CoreBundle\Entity\FDCPageWebTvLive $FDCPageWebTvLive = null)
    {
        $this->FDCPageWebTvLive = $FDCPageWebTvLive;

        return $this;
    }

    /**
     * Get FDCPageWebTvLive
     *
     * @return \Base\CoreBundle\Entity\FDCPageWebTvLive 
     */
    public function getFDCPageWebTvLive()
    {
        return $this->FDCPageWebTvLive;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $association
     * @return FDCPageWebTvLiveFilmFilmAssociated
     */
    public function setAssociation(\Base\CoreBundle\Entity\FilmFilm $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmFilm 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}

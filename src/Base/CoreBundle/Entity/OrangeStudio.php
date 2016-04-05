<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrangeProgrammationOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class OrangeStudio extends Orange
{
    use Translatable;
    
    /**
     * @var FilmFilm
     *
     * @ORM\OneToMany(targetEntity="OrangeStudioFilmAssociated", mappedBy="orangeStudio", cascade={"persist"})
     *
     */
    private $associatedFilms;
    
    public function __construct()
    {
        parent::__construct();
        $this->associatedFilms = new ArrayCollection();
    }
    
    /**
     * Add associatedFilms
     *
     * @param OrangeStudioFilmAssociated $associatedFilms
     * @return Event
     */
    public function addAssociatedFilms(OrangeStudioFilmAssociated $associatedFilms)
    {
        $associatedFilms->setOrangeStudio($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param OrangeStudioFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilms(OrangeStudioFilmAssociated $associatedFilms)
    {
        $this->associatedFilms->removeElement($associatedFilms);
    }
    
    /**
     * Set associatedFilms
     *
     * @param  $associatedFilms
     * @return OrangeStudio
     */
    public function setAssociatedFilms($associatedFilms = null)
    {
        $this->associatedFilms = $associatedFilms;

        return $this;
    }

    /**
     * Get associatedFilms
     *
     * @return \Base\CoreBundle\Entity\AssociatedFilms
     */
    public function getAssociatedFilms()
    {
        return $this->associatedFilms;
    }
}

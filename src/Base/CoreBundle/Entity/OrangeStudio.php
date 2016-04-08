<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * OrangeProgrammationOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrangeStudio extends Orange
{
    use Translatable;
    
    /**
     * @var FilmFilm
     *
     * @ORM\OneToMany(targetEntity="OrangeStudioFilmAssociated", mappedBy="orangeStudio", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"orange_studio"})
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
    public function addAssociatedFilm(OrangeStudioFilmAssociated $associatedFilms)
    {
        $associatedFilms->setOrangeStudio($this);
        $this->associatedFilms->add($associatedFilms);

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param OrangeStudioFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(OrangeStudioFilmAssociated $associatedFilms)
    {
        $this->associatedFilms->removeElement($associatedFilms);
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
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId() && $this->findTranslationByLocale('fr')) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
            $string = $this->truncate($string, 40, '..."', true);
        }

        return $string;
    }
}

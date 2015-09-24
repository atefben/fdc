<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmFilmPerson
 *
 * @ORM\Table(
 *  uniqueConstraints={@ORM\UniqueConstraint(columns={
 *      "film_id", "person_id"
 *  })})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"film", "person"})
 */
class FilmFilmPerson
{
    use Time;
    use Translatable;
    use Translation;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="persons", cascade={"persist"})
     * @ORM\JoinColumn(name="film_id", referencedColumnName="id", nullable=false)
     */
    private $film;

    /**
     * @var FilmPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="persons", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=true)
     *
     * @TODO: set nullable false / true ? related to FDC_Questions_LOT1_20150923 point 4
     */
    private $person;

    /**
     * @var FilmFilmPersonFunction
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPersonFunction", mappedBy="filmPerson", cascade={"persist"})
     */
    private $functions;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
         $this->functions = new ArrayCollection();
         $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        $string = '';
        if ($this->getPerson() !== null) {
            $string = $this->getPerson()->getFullname(). ' - ';
            if ($this->getFunctions() !== null) {
                foreach ($this->getFunctions() as $key => $filmPersonFunction) {
                    if ($filmPersonFunction->getFunction() !== null) {
                        $translation  = $filmPersonFunction->getFunction()->findTranslationByLocale('fr');
                        if ($translation !== null) {
                            $string .= $translation->getName();
                           
                        }
                        $string .= (($key + 1) < $this->getFunctions()->count()) ? ', ' : '';
                    }
                }
            } else {
                $string .= 'Non renseigné';
            }
        }
        
        return $string;
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
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmFilmPerson
     */
    public function setFilm(\FDC\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \FDC\CoreBundle\Entity\FilmFilm 
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmFilmPerson
     */
    public function setPerson(\FDC\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \FDC\CoreBundle\Entity\FilmPerson 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add functions
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPersonFunction $functions
     * @return FilmFilmPerson
     */
    public function addFunction(\FDC\CoreBundle\Entity\FilmFilmPersonFunction $functions)
    {
        if ($this->functions->contains($functions)) {
            return;
        }
        
        $functions->setFilmPerson($this);
        $this->functions[] = $functions;

        return $this;
    }

    /**
     * Remove functions
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPersonFunction $functions
     */
    public function removeFunction(\FDC\CoreBundle\Entity\FilmFilmPersonFunction $functions)
    {
        if (!$this->functions->contains($functions)) {
            return;
        }
        
        $this->functions->removeElement($functions);
    }

    /**
     * Get functions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFunctions()
    {
        return $this->functions;
    }
}

<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

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
class FilmFilmPerson implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

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
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="films", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=true)
     *
     * @TODO: set nullable false / true ? related to FDC_Questions_LOT1_20150923 point 4
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list",
     *     "news_show",
     *     "home",
     *     "film_selection_section_show"
     * })
     */
    private $person;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list",
     *     "news_show"
     * })
     */
    private $position;

    /**
     * @var FilmFilmPersonFunction
     *
     * @ORM\OneToMany(targetEntity="FilmFilmPersonFunction", mappedBy="filmPerson", cascade={"all"})
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "projection_show"
     * })
     */
    private $functions;

    /**
     * @var ArrayCollection
     *
     * @Groups({"film_list", "film_show"})
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
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return FilmFilmPerson
     */
    public function setFilm(\Base\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Base\CoreBundle\Entity\FilmFilm
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $person
     * @return FilmFilmPerson
     */
    public function setPerson(\Base\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmPerson
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add functions
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPersonFunction $functions
     * @return FilmFilmPerson
     */
    public function addFunction(\Base\CoreBundle\Entity\FilmFilmPersonFunction $functions)
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
     * @param \Base\CoreBundle\Entity\FilmFilmPersonFunction $functions
     */
    public function removeFunction(\Base\CoreBundle\Entity\FilmFilmPersonFunction $functions)
    {
        if (!$this->functions->contains($functions)) {
            return;
        }
        
        $this->functions->removeElement($functions);
    }

    public function setFunctions($functions)
    {
        $this->functions = $functions;
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

    /**
     * Set position
     *
     * @param integer $position
     * @return FilmFilmPerson
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}

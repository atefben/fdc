<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmSelection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmSelectionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmSelection implements TranslateMainInterface
{
    use Time;
    use TranslateMain;

    const CANNES_CLASSICS = 4;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({"film_selection_list", "film_selection_section_list", "film_selection_show", "film_list", "film_show"})})
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"film_selection_list", "film_selection_section_list", "film_selection_show", "film_list", "film_show"})
     */
    protected $codeSignup;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\OneToMany(targetEntity="FilmSelectionSection", mappedBy="selection", cascade={"persist"})
     *
     * @Groups({"film_selection_list", "film_selection_section_list", "film_selection_show"})
     */
    protected $sections;
    
    /**
     * @var FilmSelectionSubsection
     *
     * @ORM\OneToMany(targetEntity="FilmSelectionSubsection", mappedBy="selection", cascade={"persist"})
     *
     * @Groups({"film_selection_list", "film_selection_section_list", "film_selection_show"})
     */
    protected $subsections;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="selection")
     */
    protected $films;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->subsections = new ArrayCollection();
        $this->films = new ArrayCollection();
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
     * Set codeSignup
     *
     * @param string $codeSignup
     * @return FilmSelection
     */
    public function setCodeSignup($codeSignup)
    {
        $this->codeSignup = $codeSignup;

        return $this;
    }

    /**
     * Get codeSignup
     *
     * @return string 
     */
    public function getCodeSignup()
    {
        return $this->codeSignup;
    }

    /**
     * Add sections
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSection $sections
     * @return FilmSelection
     */
    public function addSection(\Base\CoreBundle\Entity\FilmSelectionSection $sections)
    {
        if ($this->sections->contains($sections)) {
            return;
        }
        
        $sections->setSelection($this);
        $this->sections[] = $sections;

        return $this;
    }

    /**
     * Remove sections
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSection $sections
     */
    public function removeSection(\Base\CoreBundle\Entity\FilmSelectionSection $sections)
    {
        if (!$this->sections->contains($sections)) {
            return;
        }
        
        $this->sections->removeElement($sections);
    }

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Add subsections
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSubsection $subsections
     * @return FilmSelection
     */
    public function addSubsection(\Base\CoreBundle\Entity\FilmSelectionSubsection $subsections)
    {
        if ($this->subsections->contains($subsections)) {
            return;
        }
        
        $subsections->setSelection($this);
        $this->subsections[] = $subsections;

        return $this;
    }

    /**
     * Remove subsections
     *
     * @param \Base\CoreBundle\Entity\FilmSelectionSubsection $subsections
     */
    public function removeSubsection(\Base\CoreBundle\Entity\FilmSelectionSubsection $subsections)
    {
        if (!$this->subsections->contains($subsections)) {
            return;
        }
        
        $this->subsections->removeElement($subsections);
    }

    /**
     * Get subsections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubsections()
    {
        return $this->subsections;
    }

    /**
     * Add films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     * @return FilmSelection
     */
    public function addFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films->removeElement($films);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilms()
    {
        return $this->films;
    }
}

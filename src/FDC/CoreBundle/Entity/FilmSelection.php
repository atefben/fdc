<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;

/**
 * FilmSelection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmSelection
{
    use Time;
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
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $codeSignup;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\OneToMany(targetEntity="FilmSelectionSection", mappedBy="selection", cascade={"persist"})
     */
    private $sections;
    
    /**
     * @var FilmSelectionSubsection
     *
     * @ORM\OneToMany(targetEntity="FilmSelectionSubsection", mappedBy="selection", cascade={"persist"})
     */
    private $subsections;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="selection")
     */
    private $films;

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
     * @param \FDC\CoreBundle\Entity\FilmSelectionSection $sections
     * @return FilmSelection
     */
    public function addSection(\FDC\CoreBundle\Entity\FilmSelectionSection $sections)
    {
        $sections->setSelection($this);
        $this->sections[] = $sections;

        return $this;
    }

    /**
     * Remove sections
     *
     * @param \FDC\CoreBundle\Entity\FilmSelectionSection $sections
     */
    public function removeSection(\FDC\CoreBundle\Entity\FilmSelectionSection $sections)
    {
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
     * @param \FDC\CoreBundle\Entity\FilmSelectionSubsection $subsections
     * @return FilmSelection
     */
    public function addSubsection(\FDC\CoreBundle\Entity\FilmSelectionSubsection $subsections)
    {
        $subsections->setSelection($this);
        $this->subsections[] = $subsections;

        return $this;
    }

    /**
     * Remove subsections
     *
     * @param \FDC\CoreBundle\Entity\FilmSelectionSubsection $subsections
     */
    public function removeSubsection(\FDC\CoreBundle\Entity\FilmSelectionSubsection $subsections)
    {
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
}

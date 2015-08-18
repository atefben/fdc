<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;

/**
 * FilmSelectionSubsection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmSelectionSubsection
{
    use Time;
    use Translatable;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    
    /**
     * @var ArrayCollection
     */
    protected $translations;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmSelection", inversedBy="subsections", cascade={"persist"})
     */
    private $selection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Set selection
     *
     * @param \FDC\CoreBundle\Entity\FilmSelection $selection
     * @return FilmSelectionSubsection
     */
    public function setSelection(\FDC\CoreBundle\Entity\FilmSelection $selection = null)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return \FDC\CoreBundle\Entity\FilmSelection 
     */
    public function getSelection()
    {
        return $this->selection;
    }


    /**
     * Set id
     *
     * @param string $id
     * @return FilmSelectionSubsection
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
}

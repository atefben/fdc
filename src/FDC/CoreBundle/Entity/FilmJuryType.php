<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\TranslationByLocale;

/**
 * FilmJuryType
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmJuryType
{
    use Time;
    use Translatable;
    use TranslationByLocale;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="type")
     */
    private $juries;
    
    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->juries = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmJuryType
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Add juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     * @return FilmJuryType
     */
    public function addJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        if ($this->juries->contains($juries)) {
            return;
        }

        $this->juries[] = $juries;

        return $this;
    }

    /**
     * Remove juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        if (!$this->juries->contains($juries)) {
            return;
        }
        
        $this->juries->removeElement($juries);
    }

    /**
     * Get juries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJuries()
    {
        return $this->juries;
    }
}

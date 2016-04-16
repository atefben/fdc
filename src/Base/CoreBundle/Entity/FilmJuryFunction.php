<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmJuryFonction
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmJuryFunction implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     *
     * @Groups({"jury_list", "jury_show"})
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="function")
     */
    private $juries;

    /**
     * @var ArrayCollection
     *
     * @Groups({"jury_list", "jury_show"})
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
     * @return FilmJuryFunction
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
     * Set functionVf
     *
     * @param string $functionVf
     * @return FilmJuryFunction
     */
    public function setFunctionVf($functionVf)
    {
        $this->functionVf = $functionVf;

        return $this;
    }

    /**
     * Get functionVf
     *
     * @return string 
     */
    public function getFunctionVf()
    {
        return $this->functionVf;
    }

    /**
     * Set functionVa
     *
     * @param string $functionVa
     * @return FilmJuryFunction
     */
    public function setFunctionVa($functionVa)
    {
        $this->functionVa = $functionVa;

        return $this;
    }

    /**
     * Get functionVa
     *
     * @return string 
     */
    public function getFunctionVa()
    {
        return $this->functionVa;
    }

    /**
     * Add juries
     *
     * @param \Base\CoreBundle\Entity\FilmJury $juries
     * @return FilmJuryFunction
     */
    public function addJury(\Base\CoreBundle\Entity\FilmJury $juries)
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
     * @param \Base\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\Base\CoreBundle\Entity\FilmJury $juries)
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

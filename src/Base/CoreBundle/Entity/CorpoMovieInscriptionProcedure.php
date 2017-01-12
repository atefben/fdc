<?php

namespace Base\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CorpoMovieInscriptionProcedure
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoMovieInscriptionProcedure implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf", cascade={"persist", "remove"})
     */
    protected $pdf;

    /**
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $procedureFile;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $mainImage;
   
    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $backgroundImage;

    /**
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $procedureSecondFile;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $displayReglement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $displayInscription;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $displayContact;

    /**
     * ArrayCollection
     */
    protected $translations;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = ' "' . $this->findTranslationByLocale('fr')->getTitle()  .'"';
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
     * Set pdf
     *
     * @param \Base\CoreBundle\Entity\MediaPdf $pdf
     * @return CorpoMovieInscriptionProcedure
     */
    public function setPdf(\Base\CoreBundle\Entity\MediaPdf $pdf = null)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return \Base\CoreBundle\Entity\MediaPdf 
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set procedureFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $procedureFile
     * @return CorpoMovieInscriptionProcedure
     */
    public function setProcedureFile(\Application\Sonata\MediaBundle\Entity\Media $procedureFile = null)
    {
        $this->procedureFile = $procedureFile;

        return $this;
    }

    /**
     * Get procedureFile
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getProcedureFile()
    {
        return $this->procedureFile;
    }

    /**
     * Set procedureSecondFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $procedureSecondFile
     * @return CorpoMovieInscriptionProcedure
     */
    public function setProcedureSecondFile(\Application\Sonata\MediaBundle\Entity\Media $procedureSecondFile = null)
    {
        $this->procedureSecondFile = $procedureSecondFile;

        return $this;
    }

    /**
     * Get procedureSecondFile
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getProcedureSecondFile()
    {
        return $this->procedureSecondFile;
    }

    /**
     * Set mainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $mainImage
     * @return CorpoMovieInscriptionProcedure
     */
    public function setMainImage(\Base\CoreBundle\Entity\MediaImageSimple $mainImage = null)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Set displayReglement
     *
     * @param boolean $displayReglement
     * @return CorpoMovieInscriptionProcedure
     */
    public function setDisplayReglement($displayReglement)
    {
        $this->displayReglement = $displayReglement;

        return $this;
    }

    /**
     * Get displayReglement
     *
     * @return boolean 
     */
    public function getDisplayReglement()
    {
        return $this->displayReglement;
    }

    /**
     * Set displayInscription
     *
     * @param boolean $displayInscription
     * @return CorpoMovieInscriptionProcedure
     */
    public function setDisplayInscription($displayInscription)
    {
        $this->displayInscription = $displayInscription;

        return $this;
    }

    /**
     * Get displayInscription
     *
     * @return boolean 
     */
    public function getDisplayInscription()
    {
        return $this->displayInscription;
    }

    /**
     * Set displayContact
     *
     * @param boolean $displayContact
     * @return CorpoMovieInscriptionProcedure
     */
    public function setDisplayContact($displayContact)
    {
        $this->displayContact = $displayContact;

        return $this;
    }

    /**
     * Get displayContact
     *
     * @return boolean 
     */
    public function getDisplayContact()
    {
        return $this->displayContact;
    }

    /**
     * Set backgroundImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $backgroundImage
     * @return CorpoMovieInscriptionProcedure
     */
    public function setBackgroundImage(\Base\CoreBundle\Entity\MediaImageSimple $backgroundImage = null)
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    /**
     * Get backgroundImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }
}

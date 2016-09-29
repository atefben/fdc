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
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf", cascade={"persist", "remove"})
     */
    private $pdf;

    /**
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $procedureFile;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    private $mainImage;

    /**
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $procedureSecondFile;

    /**
     * ArrayCollection
     */
    protected $translations;

    public function __toString() {
        $trans = $this->findTranslationByLocale('fr');
        if ($trans) {
            $string = $trans->getTitle();
        } else {
            $string = substr(strrchr(get_class($this), '\\'), 1);
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
}

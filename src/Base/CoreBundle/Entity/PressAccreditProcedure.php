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
 * PressAccreditProcedure
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PressAccreditProcedure implements TranslateMainInterface
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
     * @var string
     *
     * @ORM\Column(name="procedure_link", type="string", length=122, nullable=true)
     */
    protected $procedureLink;

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
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $procedureSecondFile;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

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
     * Set procedureLink
     *
     * @param string $procedureLink
     * @return PressAccreditProcedure
     */
    public function setProcedureLink($procedureLink)
    {
        $this->procedureLink = $procedureLink;

        return $this;
    }

    /**
     * Get procedureLink
     *
     * @return string 
     */
    public function getProcedureLink()
    {
        return $this->procedureLink;
    }

    /**
     * Set procedureFile
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $procedureFile
     * @return PressAccreditProcedure
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
     * @return PressAccreditProcedure
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
     * Set pdf
     *
     * @param \Base\CoreBundle\Entity\MediaPdf $pdf
     * @return PressAccreditProcedure
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
}

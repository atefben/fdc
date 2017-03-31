<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmProgramScheduleType
 *
 * @ORM\Table(name="ccm_program_schedule_type")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProgramScheduleType implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
        /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="CcmProgramSchedule", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="scheduleType")
     */
    protected $programSchedule;
    
    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->programSchedule = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmProgramSchedule $programSchedule
     * 
     * @return $this
     */
    public function addProgramSchedule(CcmProgramSchedule $programSchedule)
    {
        $programSchedule->setScheduleType($this);
        $this->programSchedule[] = $programSchedule;

        return $this;
    }

    /**
     * @param CcmProgramSchedule $programSchedule
     */
    public function removeProgramSchedule(CcmProgramSchedule $programSchedule)
    {
        $this->programSchedule->removeElement($programSchedule);
    }

    /**
     * @return CcmProgramSchedule
     */
    public function getProgramSchedule()
    {
        return $this->programSchedule;
    }
}

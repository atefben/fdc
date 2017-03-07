<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmProgramSchedule
 *
 * @ORM\Table(name="ccm_program_schedule")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProgramSchedule implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;
    use Time;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CcmProgramSchedulesCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="schedule")
     */
    protected $schedulesCollection;

    /**
     * @var $scheduleType
     *
     * @ORM\ManyToOne(targetEntity="CcmProgramScheduleType", inversedBy="programSchedule")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $scheduleType;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->schedulesCollection = new ArrayCollection();
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
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmProgramSchedulesCollection $schedulesCollection
     * 
     * @return $this
     */
    public function addSchedulesCollection(CcmProgramSchedulesCollection $schedulesCollection)
    {
        $schedulesCollection->setSchedule($this);
        $this->schedulesCollection[] = $schedulesCollection;

        return $this;
    }

    /**
     * @param CcmProgramSchedulesCollection $schedulesCollection
     */
    public function removeSchedulesCollection(CcmProgramSchedulesCollection $schedulesCollection)
    {
        $this->schedulesCollection->removeElement($schedulesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getSchedulesCollection()
    {
        return $this->schedulesCollection;
    }

    /**
     *
     * @return CcmProgramScheduleType
     */
    function getScheduleType()
    {
        return $this->scheduleType;
    }

    /**
     *
     * @param CcmProgramScheduleType $scheduleType
     *
     * @return $this
     */
    function setScheduleType(CcmProgramScheduleType $scheduleType)
    {
        $this->scheduleType = $scheduleType;

        return $this;
    }
}

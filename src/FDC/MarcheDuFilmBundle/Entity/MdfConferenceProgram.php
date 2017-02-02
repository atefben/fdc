<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceProgram
 * @ORM\Table(name="mdf_conference_program")
 * @ORM\Entity
 */
class MdfConferenceProgram
{
    use Translatable;

    const TYPE_PRODUCERS_WORKSHOP = 'producers-workshop';
    const TYPE_PRODUCERS_NETWORK = 'producers-network';
    const TYPE_DOC_CORNER = 'doc-corner';
    const TYPE_NEXT = 'next';
    const TYPE_MIXERS = 'mixers';
    const TYPE_GOES_TO_CANNES = 'goes-to-cannes';

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="MdfProgramFile", mappedBy="conferenceProgram", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     */
    protected $files;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isActive = false;

    /**
     * @var MdfContentTemplateWidget
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidget", mappedBy="conferenceProgram", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $contentTemplateConferenceWidgets;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection", mappedBy="conferenceProgram", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $dayWidgetCollections;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * MdfContentTemplate constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contentTemplateConferenceWidgets = new ArrayCollection();
        $this->dayWidgetCollections = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getSubTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getSubTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getSubTitle();
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
     * @param MdfProgramFile $file
     */
    public function addFil(MdfProgramFile $file)
    {
        $file->setConferenceProgram($this);
        $this->files->add($file);
    }

    /**
     * @param MdfProgramFile $file
     */
    public function removeFil(MdfProgramFile $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @param MdfContentTemplateWidget $contentTemplateWidget
     */
    public function addContentTemplateConferenceWidget(MdfContentTemplateWidget $contentTemplateWidget)
    {
        $contentTemplateWidget->setConferenceProgram($this);
        $this->contentTemplateConferenceWidgets->add($contentTemplateWidget);
    }

    /**
     * @param MdfContentTemplateWidget $contentTemplateWidget
     */
    public function removeContentTemplateConferenceWidget(MdfContentTemplateWidget $contentTemplateWidget)
    {
        $this->contentTemplateConferenceWidgets->removeElement($contentTemplateWidget);
    }

    /**
     * @return ArrayCollection|MdfContentTemplateWidget
     */
    public function getContentTemplateConferenceWidgets()
    {
        return $this->contentTemplateConferenceWidgets;
    }

    /**
     * @return GalleryMdf
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param GalleryMdf $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @param MdfConferenceProgramDayCollection $widgets
     *
     * @return $this
     */
    public function addDayWidgetCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection $widgets)
    {
        $widgets->setConferenceProgram($this);
        $this->dayWidgetCollections[] = $widgets;

        return $this;
    }

    /**
     * @param MdfConferenceProgramDayCollection $widgets
     */
    public function removeDayWidgetCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramDayCollection $widgets)
    {
        $this->dayWidgetCollections->removeElement($widgets);
    }

    /**
     * @return ArrayCollection
     */
    public function getDayWidgetCollections()
    {
        return $this->dayWidgetCollections;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public static function getConferences()
    {
        return array(
            self::TYPE_DOC_CORNER => 'form.mdf.label.conference_doc_corner',
            self::TYPE_GOES_TO_CANNES => 'form.mdf.label.conference_goes_to_cannes',
            self::TYPE_MIXERS => 'form.mdf.label.conference_mixers',
            self::TYPE_NEXT => 'form.mdf.label.conference_next',
            self::TYPE_PRODUCERS_NETWORK => 'form.mdf.label.conference_producers_network',
            self::TYPE_PRODUCERS_WORKSHOP => 'form.mdf.label.conference_producers_workshop',
        );
    }
}

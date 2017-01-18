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
     * @var GalleryMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf", cascade={"all"})
     */
    protected $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

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
}

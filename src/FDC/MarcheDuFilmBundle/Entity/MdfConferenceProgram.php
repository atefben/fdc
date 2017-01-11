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
     * @var MdfContentTemplateWidget
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidget", mappedBy="conferenceProgram", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $contentTemplateWidgets;

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
        $this->contentTemplateWidgets = new ArrayCollection();
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
    public function addContentTemplateWidget(MdfContentTemplateWidget $contentTemplateWidget)
    {
        $contentTemplateWidget->setContentTemplate($this);
        $this->contentTemplateWidgets->add($contentTemplateWidget);
    }

    /**
     * @param MdfContentTemplateWidget $contentTemplateWidget
     */
    public function removeContentTemplateWidget(MdfContentTemplateWidget $contentTemplateWidget)
    {
        $this->contentTemplateWidgets->removeElement($contentTemplateWidget);
    }

    /**
     * @return ArrayCollection|MdfContentTemplateWidget
     */
    public function getContentTemplateWidgets()
    {
        return $this->contentTemplateWidgets;
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
}

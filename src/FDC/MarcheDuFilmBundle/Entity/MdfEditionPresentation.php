<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfEditionPresentation
 * @ORM\Table(name="mdf_edition_presentation")
 * @ORM\Entity
 */
class MdfEditionPresentation
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
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var MdfContentTemplateWidget
     *
     * @ORM\OneToMany(targetEntity="MdfContentTemplateWidget", mappedBy="contentTemplate", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $contentTemplateWidgets;

    /**
     * MdfEditionPresentation constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->contentTemplateWidgets = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
}

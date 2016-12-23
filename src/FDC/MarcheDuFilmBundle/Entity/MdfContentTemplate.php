<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplate
 * @ORM\Table(name="mdf_content_template")
 * @ORM\Entity
 */
class MdfContentTemplate
{
    use Translatable;

    const TYPE_EDITION_PRESENTATION = 'edition_presentation';

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

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
     * MdfContentTemplate constructor.
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

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}

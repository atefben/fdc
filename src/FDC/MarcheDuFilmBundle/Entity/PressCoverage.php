<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PressCoverage
 * @ORM\Table(name="mdf_press_coverage")
 * @ORM\Entity
 */
class PressCoverage
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
     * @ORM\OneToMany(targetEntity="PressCoverageWidget", mappedBy="pressCoverage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $pressCoverageWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->pressCoverageWidgets = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPressCoverageWidgets()
    {
        return $this->pressCoverageWidgets;
    }

    /**
     * @param PressCoverageWidget $pressCoverageWidget
     *
     * @return $this
     */
    public function addPressCoverageWidget(PressCoverageWidget $pressCoverageWidget)
    {
        if (!$this->pressCoverageWidgets->contains($pressCoverageWidget)) {
            $this->pressCoverageWidgets->add($pressCoverageWidget);
            $pressCoverageWidget->setPressCoverage($this);
        }

        return $this;
    }

    /**
     * @param PressCoverageWidget $pressCoverageWidget
     *
     * @return $this
     */
    public function removePressCoverageWidget(PressCoverageWidget $pressCoverageWidget)
    {
        if ($this->pressCoverageWidgets->contains($pressCoverageWidget)) {
            $this->pressCoverageWidgets->removeElement($pressCoverageWidget);
        }

        return $this;
    }
}

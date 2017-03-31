<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfPressGraphicalCharter
 * @ORM\Table(name="mdf_press_graphical_charter")
 * @ORM\Entity
 */
class MdfPressGraphicalCharter
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
     * @ORM\OneToMany(targetEntity="MdfPressGraphicalCharterWidget", mappedBy="pressGraphicalCharter", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $pressGraphicalCharterWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->pressGraphicalCharterWidgets = new ArrayCollection();
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
    public function getPressGraphicalCharterWidgets()
    {
        return $this->pressGraphicalCharterWidgets;
    }

    /**
     * @param MdfPressGraphicalCharterWidget $pressGraphicalCharterWidgets
     *
     * @return $this
     */
    public function addPressGraphicalCharterWidget(MdfPressGraphicalCharterWidget $pressGraphicalCharterWidgets)
    {
        if (!$this->pressGraphicalCharterWidgets->contains($pressGraphicalCharterWidgets)) {
            $this->pressGraphicalCharterWidgets->add($pressGraphicalCharterWidgets);
            $pressGraphicalCharterWidgets->setPressGraphicalCharter($this);
        }

        return $this;
    }

    /**
     * @param MdfPressGraphicalCharterWidget $pressGalleryWidget
     *
     * @return $this
     */
    public function removePressGraphicalCharterWidget(MdfPressGraphicalCharterWidget $pressGraphicalCharterWidgets)
    {
        if ($this->pressGraphicalCharterWidgets->contains($pressGraphicalCharterWidgets)) {
            $this->pressGraphicalCharterWidgets->removeElement($pressGraphicalCharterWidgets);
        }

        return $this;
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

    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }
}

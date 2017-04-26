<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProgramIndustryDispatch
 * @ORM\Table(name="mdf_program_industry_dispatch")
 * @ORM\Entity
 */
class ProgramIndustryDispatch
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
     * @ORM\OneToMany(targetEntity="ProgramIndustryDispatchWidget", mappedBy="programIndustryDispatch", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $dispatchWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->dispatchWidgets = new ArrayCollection();
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
    public function getDispatchWidgets()
    {
        return $this->dispatchWidgets;
    }

    /**
     * @param ProgramIndustryDispatchWidget $dispatchWidget
     *
     * @return $this
     */
    public function addDispatchWidget(ProgramIndustryDispatchWidget $dispatchWidget)
    {
        if (!$this->dispatchWidgets->contains($dispatchWidget)) {
            $this->dispatchWidgets->add($dispatchWidget);
            $dispatchWidget->setProgramIndustryDispatch($this);
        }

        return $this;
    }

    /**
     * @param ProgramIndustryDispatchWidget $dispatchWidget
     *
     * @return $this
     */
    public function removeDispatchWidget(ProgramIndustryDispatchWidget $dispatchWidget)
    {
        if ($this->dispatchWidgets->contains($dispatchWidget)) {
            $this->dispatchWidgets->removeElement($dispatchWidget);
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

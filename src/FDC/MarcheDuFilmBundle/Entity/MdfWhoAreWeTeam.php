<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfWhoAreWeTeam
 * @ORM\Table(name="mdf_who_are_we_team")
 * @ORM\Entity
 */
class MdfWhoAreWeTeam
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
     * @ORM\OneToMany(targetEntity="MdfWhoAreWeTeamWidget", mappedBy="whoAreWeTeam", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $whoAreWeTeamWidgets;

    /**
     * @ORM\OneToMany(targetEntity="MdfWhoAreWeTeamContactWidget", mappedBy="whoAreWeTeam", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *     min = "1",
     *     max = "2",
     *     maxMessage = "validation.who_are_we_length"
     * )
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $whoAreWeTeamContactWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->whoAreWeTeamWidgets = new ArrayCollection();
        $this->whoAreWeTeamContactWidgets= new ArrayCollection();
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
    public function getWhoAreWeTeamWidgets()
    {
        return $this->whoAreWeTeamWidgets;
    }

    /**
     * @param MdfWhoAreWeTeamWidget $whoAreWeTeamWidget
     *
     * @return $this
     */
    public function addWhoAreWeTeamWidget(MdfWhoAreWeTeamWidget $whoAreWeTeamWidget)
    {
        if (!$this->whoAreWeTeamWidgets->contains($whoAreWeTeamWidget)) {
            $this->whoAreWeTeamWidgets->add($whoAreWeTeamWidget);
            $whoAreWeTeamWidget->setWhoAreWeTeam($this);
        }

        return $this;
    }

    /**
     * @param MdfWhoAreWeTeamWidget $whoAreWeTeamWidget
     *
     * @return $this
     */
    public function removeWhoAreWeTeamWidget(MdfWhoAreWeTeamWidget $whoAreWeTeamWidget)
    {
        if ($this->whoAreWeTeamWidgets->contains($whoAreWeTeamWidget)) {
            $this->whoAreWeTeamWidgets->removeElement($whoAreWeTeamWidget);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWhoAreWeTeamContactWidgets()
    {
        return $this->whoAreWeTeamContactWidgets;
    }

    /**
     * @param MdfWhoAreWeTeamContactWidget $whoAreWeTeamContactWidget
     *
     * @return $this
     */
    public function addWhoAreWeTeamContactWidget(MdfWhoAreWeTeamContactWidget $whoAreWeTeamContactWidget)
    {
        if (!$this->whoAreWeTeamContactWidgets->contains($whoAreWeTeamContactWidget)) {
            $this->whoAreWeTeamContactWidgets->add($whoAreWeTeamContactWidget);
            $whoAreWeTeamContactWidget->setWhoAreWeTeam($this);
        }

        return $this;
    }

    /**
     * @param MdfWhoAreWeTeamContactWidget $whoAreWeTeamContactWidget
     *
     * @return $this
     */
    public function removeWhoAreWeTeamContactWidget(MdfWhoAreWeTeamContactWidget $whoAreWeTeamContactWidget)
    {
        if ($this->whoAreWeTeamContactWidgets->contains($whoAreWeTeamContactWidget)) {
            $this->whoAreWeTeamContactWidgets->removeElement($whoAreWeTeamContactWidget);
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

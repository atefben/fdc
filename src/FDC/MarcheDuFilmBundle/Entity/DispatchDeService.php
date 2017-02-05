<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;

/**
 * DispatchDeService
 * @ORM\Table(name="mdf_dispatch_de_service")
 * @ORM\Entity
 */
class DispatchDeService
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
     * @ORM\OneToMany(targetEntity="DispatchDeServiceWidget", mappedBy="dispatchDeService", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $dispatchDeServiceWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->dispatchDeServiceWidgets = new ArrayCollection();
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
    public function getDispatchDeServiceWidgets()
    {
        return $this->dispatchDeServiceWidgets;
    }

    /**
     * @param DispatchDeServiceWidget $dispatchDeServiceWidget
     *
     * @return $this
     */
    public function addDispatchDeServiceWidget(DispatchDeServiceWidget $dispatchDeServiceWidget)
    {
        if (!$this->dispatchDeServiceWidgets->contains($dispatchDeServiceWidget)) {
            $this->dispatchDeServiceWidgets->add($dispatchDeServiceWidget);
            $dispatchDeServiceWidget->setDispatchDeService($this);
        }

        return $this;
    }

    /**
     * @param DispatchDeServiceWidget $dispatchDeServiceWidget
     *
     * @return $this
     */
    public function removeDispatchDeServiceWidget(DispatchDeServiceWidget $dispatchDeServiceWidget)
    {
        if ($this->dispatchDeServiceWidgets->contains($dispatchDeServiceWidget)) {
            $this->dispatchDeServiceWidgets->removeElement($dispatchDeServiceWidget);
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

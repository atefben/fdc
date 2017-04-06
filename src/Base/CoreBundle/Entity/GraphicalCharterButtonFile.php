<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButtonFile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\GraphicalCharterButtonFileRepository")
 */
class GraphicalCharterButtonFile
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
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="graphicalCharterButtonFile")
     */
    protected $graphicalCharterButtonFileCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;


    /**
     * CcmLabelFile constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->graphicalCharterButtonFileCollection = new ArrayCollection();
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
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getFileTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getFileTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getFileTitle();
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

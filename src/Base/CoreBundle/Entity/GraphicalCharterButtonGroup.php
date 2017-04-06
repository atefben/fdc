<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButton
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\GraphicalCharterButtonGroupRepository")
 */
class GraphicalCharterButtonGroup implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection", mappedBy="graphicalCharterButtonGroup", cascade={"all"}, orphanRemoval=true)
     */
    protected $graphicalCharterButtonGroupSectionCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * GraphicalCharterButtonGroup constructor.
     */
    public function __construct()
    {
        $this->graphicalCharterButtonGroupSectionCollection = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
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
            $string = $translation->getBoName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getBoName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getBoName();
        }

        return $string;
    }

    /**
     * @param $locale
     * @return GraphicalCharterButtonGroup
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * Add graphicalCharterButtonGroupSectionCollection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection $graphicalCharterButtonGroupSectionCollection
     * @return GraphicalCharterButtonGroup
     */
    public function addGraphicalCharterButtonGroupSectionCollection(\Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection $graphicalCharterButtonGroupSectionCollection)
    {
        $this->graphicalCharterButtonGroupSectionCollection[] = $graphicalCharterButtonGroupSectionCollection;
        $graphicalCharterButtonGroupSectionCollection->setGraphicalCharterButtonGroup($this);

        return $this;
    }

    /**
     * Remove graphicalCharterButtonGroupSectionCollection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection $graphicalCharterButtonGroupSectionCollection
     */
    public function removeGraphicalCharterButtonGroupSectionCollection(\Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection $graphicalCharterButtonGroupSectionCollection)
    {
        $this->graphicalCharterButtonGroupSectionCollection->removeElement($graphicalCharterButtonGroupSectionCollection);
    }

    /**
     * Get graphicalCharterButtonGroupSectionCollection
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGraphicalCharterButtonGroupSectionCollection()
    {
        return $this->graphicalCharterButtonGroupSectionCollection;
    }
}

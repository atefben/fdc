<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButtonSection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Entity\GraphicalCharterButtonSectionRepository")
 */
class GraphicalCharterButtonSection
{

    use Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection", mappedBy="graphicalCharterButtonSection")
     */
    protected $graphicalCharterButtonGroupSectionCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection", mappedBy="graphicalCharterButtonSection", cascade={"all"}, orphanRemoval=true)
     */
    protected $graphicalCharterButtonFileCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;


    public function __construct()
    {
        $this->graphicalCharterButtonGroupSectionCollection = new ArrayCollection();
        $this->graphicalCharterButtonFileCollection = new ArrayCollection();
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
     * Add graphicalCharterButtonGroupSectionCollection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection $graphicalCharterButtonGroupSectionCollection
     * @return GraphicalCharterButtonSection
     */
    public function addGraphicalCharterButtonGroupSectionCollection(\Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection $graphicalCharterButtonGroupSectionCollection)
    {
        $this->graphicalCharterButtonGroupSectionCollection[] = $graphicalCharterButtonGroupSectionCollection;

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

    /**
     * Add graphicalCharterButtonFileCollection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection $graphicalCharterButtonFileCollection
     * @return GraphicalCharterButtonSection
     */
    public function addGraphicalCharterButtonFileCollection(\Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection $graphicalCharterButtonFileCollection)
    {
        $this->graphicalCharterButtonFileCollection[] = $graphicalCharterButtonFileCollection;
        $graphicalCharterButtonFileCollection->setGraphicalCharterButtonSection($this);

        return $this;
    }

    /**
     * Remove graphicalCharterButtonFileCollection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection $graphicalCharterButtonFileCollection
     */
    public function removeGraphicalCharterButtonFileCollection(\Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection $graphicalCharterButtonFileCollection)
    {
        $this->graphicalCharterButtonFileCollection->removeElement($graphicalCharterButtonFileCollection);
    }

    /**
     * Get graphicalCharterButtonFileCollection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGraphicalCharterButtonFileCollection()
    {
        return $this->graphicalCharterButtonFileCollection;
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
            $string = $translation->getButtonsSectionTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string)$string;
    }

    public function getButtonsSectionTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getButtonsSectionTitle();
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

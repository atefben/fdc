<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\GraphicalCharterRepository")
 */
class GraphicalCharter
{

    use Translatable;
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
     */
    protected $translations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Base\CoreBundle\Entity\GraphicalCharterSectionPosition", mappedBy="graphicalCharter", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $graphicalCharterSections;

    /**
     * CcmLabel constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        return 'Charte graphique';
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

    /**
     * @param $locale
     * @return GraphicalCharterTranslation|null
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
     * Add graphicalCharterSections
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharterSections
     * @return GraphicalCharter
     */
    public function addGraphicalCharterSection(\Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharterSections)
    {
        $this->graphicalCharterSections[] = $graphicalCharterSections;
        $graphicalCharterSections->setGraphicalCharter($this);

        return $this;
    }

    /**
     * Remove graphicalCharterSections
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharterSections
     */
    public function removeGraphicalCharterSection(\Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharterSections)
    {
        $this->graphicalCharterSections->removeElement($graphicalCharterSections);
    }

    /**
     * Get graphicalCharterSections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGraphicalCharterSections()
    {
        return $this->graphicalCharterSections;
    }
}

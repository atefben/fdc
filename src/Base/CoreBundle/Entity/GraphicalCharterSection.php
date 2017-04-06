<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSection
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\GraphicalCharterSectionRepository")
 */
class GraphicalCharterSection
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
     *
     * @ORM\OneToMany(targetEntity="GraphicalCharterSectionWidget", mappedBy="graphicalCharterSection", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $graphicalCharterSectionsWidgets;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="GraphicalCharterSectionPosition", mappedBy="graphicalCharterSection", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $graphicalCharters;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmLabelSection constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->graphicalCharterSectionsWidgets = new ArrayCollection();
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
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
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

    /**
     * Add graphicalCharterSectionsWidgets
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSectionWidget $graphicalCharterSectionsWidgets
     * @return GraphicalCharterSection
     */
    public function addGraphicalCharterSectionsWidget(\Base\CoreBundle\Entity\GraphicalCharterSectionWidget $graphicalCharterSectionsWidgets)
    {
        $this->graphicalCharterSectionsWidgets[] = $graphicalCharterSectionsWidgets;
        $graphicalCharterSectionsWidgets->setGraphicalCharterSection($this);

        return $this;
    }

    /**
     * Remove graphicalCharterSectionsWidgets
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSectionWidget $graphicalCharterSectionsWidgets
     */
    public function removeGraphicalCharterSectionsWidget(\Base\CoreBundle\Entity\GraphicalCharterSectionWidget $graphicalCharterSectionsWidgets)
    {
        $this->graphicalCharterSectionsWidgets->removeElement($graphicalCharterSectionsWidgets);
    }

    /**
     * Get graphicalCharterSectionsWidgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGraphicalCharterSectionsWidgets()
    {
        return $this->graphicalCharterSectionsWidgets;
    }

    /**
     * Add graphicalCharters
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharters
     * @return GraphicalCharterSection
     */
    public function addGraphicalCharter(\Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharters)
    {
        $this->graphicalCharters[] = $graphicalCharters;

        return $this;
    }

    /**
     * Remove graphicalCharters
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharters
     */
    public function removeGraphicalCharter(\Base\CoreBundle\Entity\GraphicalCharterSectionPosition $graphicalCharters)
    {
        $this->graphicalCharters->removeElement($graphicalCharters);
    }

    /**
     * Get graphicalCharters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGraphicalCharters()
    {
        return $this->graphicalCharters;
    }
}

<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FDC\CourtMetrageBundle\Interfaces\CcmIconInterface;
use FDC\CourtMetrageBundle\Util\CcmIcon;

/**
 * CcmParticiperPageLayer
 * @ORM\Table(name="ccm_participer_page_layer")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmParticiperPageLayer implements CcmIconInterface, TranslateMainInterface
{

    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;
    use CcmIcon;

    /**
     * @var integer
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
     * @var integer
     * @ORM\Column(name="layer_position", type="integer", nullable=true)
     */
    protected $layerPosition;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255, nullable=true)
     */
    protected $icon;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="layer")
     */
    protected $pageLayersCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmModule", mappedBy="pageLayer", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $modules;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->pageLayersCollection = new ArrayCollection();
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmModule $ccmModule
     * @return $this
     */
    public function addModule(\FDC\CourtMetrageBundle\Entity\CcmModule $ccmModule)
    {
        $ccmModule->setPageLayer($this);
        $this->modules[] = $ccmModule;

        return $this;
    }

    /**
     * @param CcmModule $ccmModule
     */
    public function removeModule(\FDC\CourtMetrageBundle\Entity\CcmModule $ccmModule)
    {
        $this->modules->removeElement($ccmModule);
    }

    /**
     * @return ArrayCollection
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return int
     */
    public function getLayerPosition()
    {
        return $this->layerPosition;
    }

    /**
     * @param int $layerPosition
     */
    public function setLayerPosition($layerPosition)
    {
        $this->layerPosition = $layerPosition;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @param CcmParticiperPageLayerCollection $layerCollection
     * @return $this
     */
    public function addPageLayersCollection(\FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerCollection $layerCollection)
    {
        $layerCollection->setLayer($this);
        $this->pageLayersCollection[] = $layerCollection;

        return $this;
    }

    /**
     * @param CcmParticiperPageLayerCollection $layerCollection
     */
    public function removePageLayersCollection(\FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerCollection $layerCollection)
    {
        $this->pageLayersCollection->removeElement($layerCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getPageLayersCollection()
    {
        return $this->pageLayersCollection;
    }
}
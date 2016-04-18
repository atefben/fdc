<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\FDCPageParticipateSectionInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FDCPageParticipateSection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSection implements TranslateMainInterface,FDCPageParticipateSectionInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var FDCPageParticipateSectionWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPageParticipateSectionWidget", mappedBy="pressDownload", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $widgets;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * @var integer
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $mobile;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $page;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stratePosition;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return void
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

    public function __toString()
    {
        if (is_object($this->findTranslationByLocale('fr'))) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
        } else {
            $string = substr(strrchr(get_class($this), '\\'), 1);
        }
        return $string;
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSectionWidget $widgets
     * @return FDCPageParticipateSection
     */
    public function addWidget(\Base\CoreBundle\Entity\FDCPageParticipateSectionWidget $widgets)
    {

        $widgets->setPressDownload($this);
        $this->widgets->add($widgets);

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSectionWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\FDCPageParticipateSectionWidget $widgets)
    {
        $widgets->setPressDownload(null);
        $this->widgets->removeElement($widgets);
    }

    /**
     * Get widgets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }


    /**
     * Set mobile
     *
     * @param boolean $mobile
     * @return FDCPageParticipateSection
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return boolean 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set page
     *
     * @param integer $page
     * @return FDCPageParticipateSection
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public static function getPages()
    {
        return array(
            self::BONNE_PRATIQUES => 'Plan',
            self::TYPES_ACCES => 'Se rendre à Cannes',
            self::FDC_MODE_EMPLOI => "Festival mode d'emploi",
            self::ACCES_PROJECTION => 'Accès aux projections',
            self::GUIDE_PRESS => 'Guide de la presse',
        );
    }



    /**
     * Set stratePosition
     *
     * @param integer $stratePosition
     * @return FDCPageParticipateSection
     */
    public function setStratePosition($stratePosition)
    {
        $this->stratePosition = $stratePosition;

        return $this;
    }

    /**
     * Get stratePosition
     *
     * @return integer 
     */
    public function getStratePosition()
    {
        return $this->stratePosition;
    }
}

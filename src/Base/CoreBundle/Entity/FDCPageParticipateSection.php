<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FDCPageParticipateSection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSection implements TranslateMainInterface
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
     * @ORM\OneToMany(targetEntity="FDCPageParticipateSectionWidget", mappedBy="FDCPageParticipate", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $widgets;

    /**
     * ArrayCollection
     */
    protected $translations;

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
        }
        else {
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

        $widgets->setFDCPageParticipate($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipateSectionWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\FDCPageParticipateSectionWidget $widgets)
    {
        $widgets->setFDCPageParticipate(null);
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

}

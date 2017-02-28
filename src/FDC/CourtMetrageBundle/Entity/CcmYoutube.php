<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\Theme;

/**
 * CcmYoutube
 * @ORM\Table(name="ccm_youtube")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmYoutube
{
    use Time;
    use Translatable;
    use SeoMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\Theme")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id", nullable=true)
     *
     */
    protected $theme;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmYoutubesCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="youtube")
     */
    protected $youtubesCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->youtubesCollection = new ArrayCollection();
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
    
    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmYoutubesCollection $youtubesCollection
     * @return $this
     */
    public function addYoutubesCollection(\FDC\CourtMetrageBundle\Entity\CcmYoutubesCollection $youtubesCollection)
    {
        $youtubesCollection->setYoutube($this);
        $this->youtubesCollection[] = $youtubesCollection;

        return $this;
    }

    /**
     * @param CcmYoutubesCollection $youtubesCollection
     */
    public function removeYoutubesCollection(\FDC\CourtMetrageBundle\Entity\CcmYoutubesCollection $youtubesCollection)
    {
        $this->youtubesCollection->removeElement($youtubesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getYoutubesCollection()
    {
        return $this->youtubesCollection;
    }

    /**
     * @param $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param Theme $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
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
}

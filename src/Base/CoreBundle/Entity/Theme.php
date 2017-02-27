<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Theme
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Theme implements TranslateMainInterface
{
    use Time;
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
     *
     * @Groups({"news_list", "search", "news_show", "event_list", "search", "event_show", "film_show", "home", "live", "search"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmNews", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="theme")
     */
    protected $ccmNews;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepageActualite", mappedBy="theme")
     */
    protected $homepageActualites;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->ccmNews = new ArrayCollection();
        $this->homepageActualites = new ArrayCollection();
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }

    public function getExportName()
    {
        return Export::translationField($this, 'name', 'fr');
    }

    public function getExportStatusMaster()
    {
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportTranslationEn()
    {
        return Export::translationField($this, 'name', 'en');
    }

    public function getExportStatusEn()
    {
        $status = $this->findTranslationByLocale('en')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportStatusEs()
    {
        $status = $this->findTranslationByLocale('es')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportTranslationEs()
    {
        return Export::translationField($this, 'name', 'es');
    }

    public function getExportStatusZh()
    {
        $status = $this->findTranslationByLocale('zh')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportTranslationZh()
    {
        return Export::translationField($this, 'name', 'zh');
    }

    /**
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews
     * @return $this
     */
    public function addCcmNews(\FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews)
    {
        $ccmNews->setTheme($this);
        $this->ccmNews[] = $ccmNews;

        return $this;
    }

    /**
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews
     */
    public function removeCcmNews(\FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews)
    {
        $this->ccmNews->removeElement($ccmNews);
    }

    /**
     * @return mixed
     */
    public function getCcmNews()
    {
        return $this->ccmNews;
    }

    /**
     * Get homepageActualite.
     *
     * @return ArrayCollection
     */
    public function getHomepageActualites()
    {
        return $this->homepageActualites;
    }

    /**
     * Set homepageActualites.
     *
     * @param ArrayCollection $homepageActualites
     */
    public function setHomepageActualites($homepageActualites)
    {
        $this->homepageActualites = $homepageActualites;

        return $this;
    }

    /**
     * Add homepageActualite.
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite
     * @return $this
     */
    public function addHomepageActualite(\FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite)
    {
        $this->homepageActualites[] = $homepageActualite;
        $homepageActualite->setTheme($this);

        return $this;
    }

    /**
     * Remove homepageActualite
     *
     * @param \FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite
     */
    public function removeHomepageActualite(\FDC\CourtMetrageBundle\Entity\HomepageActualite $homepageActualite)
    {
        $this->homepageActualites->removeElement($homepageActualite);
    }
}

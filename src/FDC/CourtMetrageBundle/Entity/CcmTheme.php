<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use FDC\CourtMetrageBundle\Entity\CcmNews;
use FDC\CourtMetrageBundle\Entity\HomepageActualite;

/**
 * CcmTheme
 *
 * @ORM\Table(name="ccm_theme")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmTheme implements TranslateMainInterface
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

    /**
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews
     * @return $this
     */
    public function addCcmNews(CcmNews $ccmNews)
    {
        $ccmNews->setTheme($this);
        $this->ccmNews[] = $ccmNews;

        return $this;
    }

    /**
     * @param \FDC\CourtMetrageBundle\Entity\CcmNews $ccmNews
     */
    public function removeCcmNews(CcmNews $ccmNews)
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
     * @return $this
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
    public function addHomepageActualite(HomepageActualite $homepageActualite)
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
    public function removeHomepageActualite(HomepageActualite $homepageActualite)
    {
        $this->homepageActualites->removeElement($homepageActualite);
    }
}

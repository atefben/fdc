<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfGlobalEvents
 * @ORM\Table(name="mdf_global_events")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfGlobalEvents implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isActive = false;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     */
    private $publishEndedAt;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection", mappedBy="globalEvent", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $daysCollection;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->daysCollection = new ArrayCollection();
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

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Service
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set publishEndedAt
     *
     * @param \DateTime $publishEndedAt
     * @return Service
     */
    public function setPublishEndedAt($publishEndedAt)
    {
        $this->publishEndedAt = $publishEndedAt;

        return $this;
    }

    /**
     * Get publishEndedAt
     *
     * @return \DateTime 
     */
    public function getPublishEndedAt()
    {
        return $this->publishEndedAt;
    }

    /**
     * Add daysCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection $daysCollection
     * @return MdfGlobalEvents
     */
    public function addDaysCollection(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection $daysCollection)
    {
        $daysCollection->setGlobalEvent($this);
        $this->daysCollection[] = $daysCollection;

        return $this;
    }

    /**
     * Remove daysCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection $daysCollection
     */
    public function removeDaysCollection(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsDaysCollection $daysCollection)
    {
        $this->daysCollection->removeElement($daysCollection);
    }

    /**
     * Get daysCollection
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDaysCollection()
    {
        return $this->daysCollection;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
}

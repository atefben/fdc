<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Entity\MediaImageSimple;

/**
 * CcmProgram
 * 
 * @ORM\Table(name="ccm_program")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProgram implements TranslateMainInterface
{
    use Time;
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
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\MediaImageSimple")
     */
    protected $image;

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
     * @ORM\OneToMany(targetEntity="CcmProgramDaysCollection", mappedBy="program", cascade={"persist", "remove"}, orphanRemoval=true)
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
        $string = 'Programmation Page';

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
     * @return $this
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
     * @return $this
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
     * @param CcmProgramDaysCollection $daysCollection
     * @return $this
     */
    public function addDaysCollection(CcmProgramDaysCollection $daysCollection)
    {
        $daysCollection->setProgram($this);
        $this->daysCollection[] = $daysCollection;

        return $this;
    }

    /**
     * Remove daysCollection
     *
     * @param CcmProgramDaysCollection $daysCollection
     */
    public function removeDaysCollection(CcmProgramDaysCollection $daysCollection)
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
     * @return MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param MediaImageSimple $image
     *
     * @return $this
     */
    public function setImage(MediaImageSimple $image)
    {
        $this->image = $image;

        return $this;
    }
}

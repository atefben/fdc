<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
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

    /**
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\HomepageSejour", mappedBy="programPage", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @Assert\Count(
     *      max = "1",
     *      maxMessage = "ccm.validation.homepage.sejour_max"
     * )
     * @Assert\Valid
     */
    protected $sejoures;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $sejourIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionSejour = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $socialIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionSocial = 0;


    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $actualiteIsActive = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionActualites = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $positionCatalog = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $catalogIsActive = false;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->daysCollection = new ArrayCollection();
        $this->sejoures =  new ArrayCollection();
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
     * @return CcmMediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param CcmMediaImageSimple $image
     *
     * @return $this
     */
    public function setImage(CcmMediaImageSimple $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get sejoures.
     *
     * @return mixed
     */
    public function getSejoures()
    {
        return $this->sejoures;
    }

    /**
     * Add sejour.
     *
     * @param HomepageSejour $sejour
     *
     * @return $this
     */
    public function addSejour(HomepageSejour $sejour)
    {
        $this->sejoures->add($sejour);
        $sejour->setProgramPage($this);

        return $this;
    }

    /**
     * Remove sejour.
     *
     * @param HomepageSejour $sejour
     */
    public function removeSejour(HomepageSejour $sejour)
    {
        $this->sejoures->removeElement($sejour);
    }

    /**
     * Get sejourIsActive.
     *
     * @return bool
     */
    public function getSejourIsActive()
    {
        return $this->sejourIsActive;
    }

    /**
     * Set sejourIsActive.
     *
     * @param bool $sejourIsActive
     *
     * @return $this
     */
    public function setSejourIsActive($sejourIsActive)
    {
        $this->sejourIsActive = $sejourIsActive;

        return $this;
    }

    /**
     * Get positionSejour.
     *
     * @return int
     */
    public function getPositionSejour()
    {
        return $this->positionSejour;
    }

    /**
     * Set positionSejour.
     *
     * @param int $positionSejour
     *
     * @return $this
     */
    public function setPositionSejour($positionSejour)
    {
        $this->positionSejour = $positionSejour;

        return $this;
    }

    /**
     * Get actualiteIsActive.
     *
     * @return bool
     */
    public function getActualiteIsActive()
    {
        return $this->actualiteIsActive;
    }

    /**
     * Set actualiteIsActive.
     *
     * @param bool $actualiteIsActive
     *
     * @return $this
     */
    public function setActualiteIsActive($actualiteIsActive)
    {
        $this->actualiteIsActive = $actualiteIsActive;

        return $this;
    }

    /**
     * Get positionActualites.
     *
     * @return int
     */
    public function getPositionActualites()
    {
        return $this->positionActualites;
    }

    /**
     * Set positionActualite.
     *
     * @param int $positionActualites
     *
     * @return $this
     */
    public function setPositionActualites($positionActualites)
    {
        $this->positionActualites = $positionActualites;

        return $this;
    }

    /**
     * Get socialIsActive.
     *
     * @return bool
     */
    public function getSocialIsActive()
    {
        return $this->socialIsActive;
    }

    /**
     * Set socialIsActive.
     *
     * @param bool $socialIsActive
     *
     * @return $this
     */
    public function setSocialIsActive($socialIsActive)
    {
        $this->socialIsActive = $socialIsActive;

        return $this;
    }

    /**
     * Get PositionSocial.
     *
     * @return int
     */
    public function getPositionSocial()
    {
        return $this->positionSocial;
    }

    /**
     * Set positionSocial.
     *
     * @param int $positionSocial
     *
     * @return $this
     */
    public function setPositionSocial($positionSocial)
    {
        $this->positionSocial = $positionSocial;

        return $this;
    }

    /**
     * Get positionCatalog.
     *
     * @return int
     */
    public function getPositionCatalog()
    {
        return $this->positionCatalog;
    }

    /**
     * Set positionCatalog.
     *
     * @param int $positionCatalog
     *
     * @return $this
     */
    public function setPositionCatalog($positionCatalog)
    {
        $this->positionCatalog = $positionCatalog;

        return $this;
    }

    /**
     * Get catalogIsActive.
     *
     * @return bool
     */
    public function getCatalogIsActive()
    {
        return $this->catalogIsActive;
    }

    /**
     * Set catalogIsActive.
     *
     * @param bool $catalogIsActive
     *
     * @return $this
     */
    public function setCatalogIsActive($catalogIsActive)
    {
        $this->catalogIsActive = $catalogIsActive;

        return $this;
    }
}

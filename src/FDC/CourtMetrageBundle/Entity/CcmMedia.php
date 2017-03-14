<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\VirtualProperty;
use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TruncatePro;

/**
 * CcmMedia
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"image" = "CcmMediaImage", "audio" = "CcmMediaAudio", "video" = "CcmMediaVideo"})
 */
abstract class CcmMedia implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;
    use TruncatePro;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var CcmTheme
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmTheme", cascade={"persist"})
     */
    protected $theme;

    /**
     * @var CcmMediaTag
     *
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaTag", mappedBy="media", cascade={"persist"})
     */
    protected $tags;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Serializer\Accessor(getter="getApiPublishedAt")
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     *
     */
    protected $publishEndedAt;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedAll;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedHome;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0}, nullable=true)
     */
    protected $excludeFromSearch;

    /**
     * @var ArrayCollection
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    protected $updatedBy;
    

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->displayedAll = false;
        $this->displayedHome = false;
        $this->displayedMobile = false;
    }

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            if ($string != 'CcmMediaImage') {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string = $this->findTranslationByLocale('fr')->getTitle();
                }
            } else {
                if ($this->findTranslationByLocale('fr') != null) {
                    $string = $this->findTranslationByLocale('fr')->getLegend();
                }
            }
        }

        return $string;
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     */
    public function getMediaType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
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
     * Add tags
     *
     * @param CcmMediaTag $tags
     * @return CcmMedia
     */
    public function addTag(CcmMediaTag $tags)
    {
        if ($this->tags->contains($tags)) {
            return;
        }

        $tags->setMedia($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param CcmMediaTag $tags
     */
    public function removeTag(CcmMediaTag $tags)
    {
        if (!$this->tags->contains($tags)) {
            return;
        }

        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
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
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getApiPublishedAt()
    {
        return $this->publishedAt ? $this->publishedAt : new \DateTime();
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
     * Set displayedAll
     *
     * @param boolean $displayedAll
     * @return CcmMedia
     */
    public function setDisplayedAll($displayedAll)
    {
        $this->displayedAll = $displayedAll;

        return $this;
    }

    /**
     * Get displayedAll
     *
     * @return boolean
     */
    public function getDisplayedAll()
    {
        return $this->displayedAll;
    }

    /**
     * Set displayedHome
     *
     * @param boolean $displayedHome
     * @return CcmMedia
     */
    public function setDisplayedHome($displayedHome)
    {
        $this->displayedHome = $displayedHome;

        return $this;
    }

    /**
     * Get displayedHome
     *
     * @return boolean
     */
    public function getDisplayedHome()
    {
        return $this->displayedHome;
    }

    /**
     * Set theme
     *
     * @param CcmTheme $theme
     * @return CcmMedia
     */
    public function setTheme(CcmTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return CcmTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return CcmMedia
     */
    public function setDisplayedMobile($displayedMobile)
    {
        $this->displayedMobile = $displayedMobile;

        return $this;
    }

    /**
     * Get displayedMobile
     *
     * @return boolean
     */
    public function getDisplayedMobile()
    {
        return $this->displayedMobile;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return CcmMedia
     */
    public function setCreatedBy(User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $updatedBy
     * @return CcmMedia
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function isElasticable()
    {
        $isElasticable = true;
        $fr = $this->findTranslationByLocale('fr');
        if (!$fr || $fr->getStatus() !== TranslateChildInterface::STATUS_PUBLISHED) {
            $isElasticable = false;
        }
        if ($this->getExcludeFromSearch()) {
            $isElasticable = false;
        }
        return $isElasticable;
    }

    /**
     * Set excludeFromSearch
     *
     * @param boolean $excludeFromSearch
     * @return CcmMedia
     */
    public function setExcludeFromSearch($excludeFromSearch)
    {
        $this->excludeFromSearch = $excludeFromSearch;

        return $this;
    }

    /**
     * Get excludeFromSearch
     *
     * @return boolean 
     */
    public function getExcludeFromSearch()
    {
        return $this->excludeFromSearch;
    }
}

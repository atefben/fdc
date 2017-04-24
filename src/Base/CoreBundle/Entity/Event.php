<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Application\Sonata\UserBundle\Entity\User;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Event implements TranslateMainInterface
{
    use SeoMain;
    use Translatable;
    use Time;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"event_list", "search", "event_list", "search"})
     */
    protected $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     *
     * @Groups({"event_list", "search", "event_show"})
     */
    protected $theme;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedMobile = false;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     */
    protected $sites;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     *
     * @Groups({"event_list", "search", "event_show"})
     */
    protected $header;


    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="events")
     */
    protected $festival;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     *
     * @Groups({"event_list", "search", "event_show"})
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     *
     * @Groups({"event_list", "search", "event_show"})
     */
    protected $publishEndedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EventTag", mappedBy="event", cascade={"all"}, orphanRemoval=true)
     */
    protected $tags;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"event_show"})
     */
    protected $signature;

    /**
     * @var EventWidget
     *
     * @ORM\OneToMany(targetEntity="EventWidget", mappedBy="events",  cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"event_show"})
     */
    protected $widgets;

    /**
     * @ORM\OneToMany(targetEntity="EventFilmProjectionAssociated", mappedBy="event", cascade={"persist"})
     *
     *
     */
    protected $associatedProjections;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     */
    protected $updatedBy;

    /**
     * ArrayCollection
     *
     * @Groups({"event_list", "search", "event_show"})
     */
    protected $translations;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $oldNewsId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $oldNewsTable;

    public function __toString()
    {
        $translationFr = $this->findTranslationByLocale('fr');
        if ($translationFr !== null) {
            return $translationFr->getTitle();
        }
        return '';
    }


    public function __construct()
    {
        $this->sites = new ArrayCollection();
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->widgets = new ArrayCollection();
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Event
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
     * @return Event
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
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return Event
     */
    public function setTheme(\Base\CoreBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return Event
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\EventWidget $widgets
     * @return Event
     */
    public function addWidget(\Base\CoreBundle\Entity\EventWidget $widgets)
    {
        $widgets->setEvents($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\EventWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\EventWidget $widgets)
    {
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
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return Event
     */
    public function addSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites[] = $sites;

        return $this;
    }

    /**
     * Remove sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     */
    public function removeSite(\Base\CoreBundle\Entity\Site $sites)
    {
        $this->sites->removeElement($sites);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Add associatedProjections
     *
     * @param EventFilmProjectionAssociated $associatedProjections
     * @return Event
     */
    public function addAssociatedProjection(EventFilmProjectionAssociated $associatedProjections)
    {
        $associatedProjections->setEvent($this);
        $this->associatedProjections[] = $associatedProjections;

        return $this;
    }

    /**
     * Remove associatedProjections
     *
     * @param EventFilmProjectionAssociated $associatedProjections
     */
    public function removeAssociatedProjection(EventFilmProjectionAssociated $associatedProjections)
    {
        $this->associatedProjections->removeElement($associatedProjections);
    }

    /**
     * Get associatedProjections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociatedProjections()
    {
        return $this->associatedProjections;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return Event
     */
    public function setCreatedBy(\Application\Sonata\UserBundle\Entity\User $createdBy = null)
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
     * @return Event
     */
    public function setUpdatedBy(\Application\Sonata\UserBundle\Entity\User $updatedBy = null)
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

    /**
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return Event
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
     * Set header
     *
     * @param \Base\CoreBundle\Entity\MediaImage $header
     * @return Event
     */
    public function setHeader(\Base\CoreBundle\Entity\MediaImage $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set signature
     *
     * @param string $signature
     * @return Event
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string 
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\EventTag $tags
     * @return Event
     */
    public function addTag(\Base\CoreBundle\Entity\EventTag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\EventTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\EventTag $tags)
    {
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
     * Set oldNewsId
     *
     * @param integer $oldNewsId
     * @return Event
     */
    public function setOldNewsId($oldNewsId)
    {
        $this->oldNewsId = $oldNewsId;

        return $this;
    }

    /**
     * Get oldNewsId
     *
     * @return integer 
     */
    public function getOldNewsId()
    {
        return $this->oldNewsId;
    }

    /**
     * Set oldNewsTable
     *
     * @param string $oldNewsTable
     * @return Event
     */
    public function setOldNewsTable($oldNewsTable)
    {
        $this->oldNewsTable = $oldNewsTable;

        return $this;
    }

    /**
     * Get oldNewsTable
     *
     * @return string 
     */
    public function getOldNewsTable()
    {
        return $this->oldNewsTable;
    }
}

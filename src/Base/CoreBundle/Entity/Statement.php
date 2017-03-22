<?php

namespace Base\CoreBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Base\AdminBundle\Component\Admin\Export;
use Base\CoreBundle\Component\Interfaces\NodeInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Statement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\StatementRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article" = "StatementArticle", "audio" = "StatementAudio", "image" = "StatementImage", "video" = "StatementVideo"})
 */
abstract class Statement implements TranslateMainInterface, NodeInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;
    use TruncatePro;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     */
    protected $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"})
     *
     * @Groups({"news_list", "search", "news_show", "home"})
     */
    protected $theme;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="statements")
     */
    protected $festival;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage")
     */
    protected $homepage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
     */
    protected $displayedHome;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
     */
    protected $displayedOnCorpoHome = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $displayedMobile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"news_show"})
     *
     */
    protected $signature;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     */
    protected $typeClone;

    /**
     * @var StatementTag
     *
     * @ORM\OneToMany(targetEntity="StatementTag", mappedBy="statement", cascade={"all"}, orphanRemoval=true)
     *
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="StatementStatementAssociated", mappedBy="statement", cascade={"persist"}, orphanRemoval=true)
     *
     */
    protected $associatedStatement;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     *
     */
    protected $associatedFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     *
     */
    protected $associatedEvent;

    /**
     * @ORM\OneToMany(targetEntity="StatementFilmProjectionAssociated", mappedBy="statement", cascade={"persist"}, orphanRemoval=true)
     *
     */
    protected $associatedProjections;

    /**
     * @ORM\OneToMany(targetEntity="StatementFilmFilmAssociated", mappedBy="statement", cascade={"persist"}, orphanRemoval=true)
     * @Groups({"news_show"})
     *
     */
    protected $associatedFilms;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="StatementWidget", mappedBy="statement", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"news_show"})
     */
    protected $widgets;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     */
    protected $sites;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({"news_list", "search", "news_show", "home"})
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     * @Groups({"news_list", "search", "news_show", "home"})
     */
    protected $publishEndedAt;

    /**
     * @var ArrayCollection
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     */
    protected $translations;

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
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     * @Groups({"news_show"})
     */
    protected $hideSameDay;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $hidden = 0;

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

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_display", type="string", nullable=true)
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     */
    protected $mobileDisplay = false;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->widgets = new ArrayCollection();
        $this->sites = new ArrayCollection();
        $this->associatedStatement = new ArrayCollection();
        $this->associatedProjections = new ArrayCollection();
        $this->associatedFilms = new ArrayCollection();
        $this->displayedHome = false;
        $this->displayedMobile = false;
        $this->hideSameDay = false;
    }

    public function __toString()
    {
        $string = null;
        $class = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            if ($this->findTranslationByLocale('fr') && $this->findTranslationByLocale('fr')->getTitle()) {
                $string = "$class " . $this->truncate($this->findTranslationByLocale('fr')->getTitle(), 40, '...', true);
            } else {
                $string = "$class {$this->getId()}";
            }
        }

        if (!$string) {
            $string = $class;
        }

        return $string;
    }

    public static function getTypes()
    {
        return [
            'Base\CoreBundle\Entity\StatementArticle' => 'article',
            'Base\CoreBundle\Entity\StatementAudio'   => 'audio',
            'Base\CoreBundle\Entity\StatementImage'   => 'photo',
            'Base\CoreBundle\Entity\StatementVideo'   => 'video'
        ];
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"home", "news_list", "search", "news_show"})
     */
    public function getStatementType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    public function getExportTitle()
    {
        return Export::translationField($this, 'title', 'fr');
    }

    public function getExportTheme()
    {
        return Export::translationField($this->getTheme(), 'name', 'fr');
    }

    public function getExportAuthor()
    {
        return $this->getCreatedBy()->getId();
    }

    public function getExportCreatedAt()
    {
        return Export::formatDate($this->getCreatedAt());
    }

    public function getExportPublishDates()
    {
        return Export::publishsDates($this->getPublishedAt(), $this->getPublishEndedAt());
    }

    public function getExportUpdatedAt()
    {
        return Export::formatDate($this->getUpdatedAt());
    }

    public function getExportStatusMaster()
    {
        $status = $this->findTranslationByLocale('fr')->getStatus();
        return Export::formatTranslationStatus($status);
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

    public function getExportStatusZh()
    {
        $status = $this->findTranslationByLocale('zh')->getStatus();
        return Export::formatTranslationStatus($status);
    }

    public function getExportSites()
    {
        return Export::sites($this->getSites());
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
     * @param \Base\CoreBundle\Entity\StatementWidget $widgets
     * @return $this
     */
    public function addWidget(\Base\CoreBundle\Entity\StatementWidget $widgets)
    {
        $widgets->setStatement($this);
        $this->widgets[] = $widgets;

        return $this;
    }

    /**
     * Remove widgets
     *
     * @param \Base\CoreBundle\Entity\StatementWidget $widgets
     */
    public function removeWidget(\Base\CoreBundle\Entity\StatementWidget $widgets)
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
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return $this
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
     * @return $this
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
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return $thisArticleTranslation
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
     * Set homepage
     *
     * @param \Base\CoreBundle\Entity\Homepage $homepage
     * @return $this
     */
    public function setHomepage(\Base\CoreBundle\Entity\Homepage $homepage = null)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return \Base\CoreBundle\Entity\Homepage
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Add tags
     *
     * @param \Base\CoreBundle\Entity\StatementTag $tags
     * @return $this
     */
    public function addTag(\Base\CoreBundle\Entity\StatementTag $tags)
    {
        $tags->setStatement($this);
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Base\CoreBundle\Entity\StatementTag $tags
     */
    public function removeTag(\Base\CoreBundle\Entity\StatementTag $tags)
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
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     * @return $this
     */
    public function setPriorityStatus($priorityStatus)
    {
        $this->priorityStatus = $priorityStatus;

        return $this;
    }

    /**
     * Get priorityStatus
     *
     * @return integer
     */
    public function getPriorityStatus()
    {
        return $this->priorityStatus;
    }

    /**
     * Set displayedHome
     *
     * @param boolean $displayedHome
     * @return $this
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
     * Set signature
     *
     * @param string $signature
     * @return $this
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
     * Set displayedMobile
     *
     * @param boolean $displayedMobile
     * @return $this
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
     * Add associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement
     * @return $this
     */
    public function addAssociatedStatement(\Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement)
    {
        $this->associatedStatement[] = $associatedStatement;

        return $this;
    }

    /**
     * Remove associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement
     */
    public function removeAssociatedStatement(\Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement)
    {
        $this->associatedStatement->removeElement($associatedStatement);
    }

    /**
     * Get associatedStatement
     *
     * @return \Base\CoreBundle\Entity\StatementStatementAssociated
     */
    public function getAssociatedStatement()
    {
        if ($this->associatedStatement->count() < 2) {
            while ($this->associatedStatement->count() != 2) {
                $entity = new StatementStatementAssociated();
                $entity->setStatement($this);
                $this->associatedStatement->add($entity);
            }
        }

        return $this->associatedStatement;
    }

    /**
     * Set associatedFilm
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $associatedFilm
     * @return $this
     */
    public function setAssociatedFilm(\Base\CoreBundle\Entity\FilmFilm $associatedFilm = null)
    {
        $this->associatedFilm = $associatedFilm;

        return $this;
    }

    /**
     * Get associatedFilm
     *
     * @return \Base\CoreBundle\Entity\FilmFilm
     */
    public function getAssociatedFilm()
    {
        return $this->associatedFilm;
    }

    /**
     * Set associatedEvent
     *
     * @param \Base\CoreBundle\Entity\Event $associatedEvent
     * @return $this
     */
    public function setAssociatedEvent(\Base\CoreBundle\Entity\Event $associatedEvent = null)
    {
        $this->associatedEvent = $associatedEvent;

        return $this;
    }

    /**
     * Get associatedEvent
     *
     * @return \Base\CoreBundle\Entity\Event
     */
    public function getAssociatedEvent()
    {
        return $this->associatedEvent;
    }

    /**
     * Add associatedProjections
     *
     * @param \Base\CoreBundle\Entity\StatementFilmProjectionAssociated $associatedProjections
     * @return $this
     */
    public function addAssociatedProjection(\Base\CoreBundle\Entity\StatementFilmProjectionAssociated $associatedProjections)
    {
        $this->associatedProjections[] = $associatedProjections;

        return $this;
    }

    /**
     * Remove associatedProjections
     *
     * @param \Base\CoreBundle\Entity\StatementFilmProjectionAssociated $associatedProjections
     */
    public function removeAssociatedProjection(\Base\CoreBundle\Entity\StatementFilmProjectionAssociated $associatedProjections)
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
     * Add associatedFilms
     *
     * @param \Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedFilms
     * @return $this
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedFilms)
    {
        $associatedFilms->setStatement($this);
        $this->associatedFilms[] = $associatedFilms;

        return $this;
    }

    /**
     * Remove associatedFilms
     *
     * @param \Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedFilms
     */
    public function removeAssociatedFilm(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedFilms)
    {
        $this->associatedFilms->removeElement($associatedFilms);
    }

    /**
     * Get associatedFilms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedFilms()
    {
        return $this->associatedFilms;
    }

    /**
     * Set createdBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $createdBy
     * @return $this
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
     * @return $this
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
     * @param StatementWidget $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
    }

    /**
     * Set hideSameDay
     *
     * @param boolean $hideSameDay
     * @return $this
     */
    public function setHideSameDay($hideSameDay)
    {
        $this->hideSameDay = $hideSameDay;

        return $this;
    }

    /**
     * Get hideSameDay
     *
     * @return boolean
     */
    public function getHideSameDay()
    {
        return $this->hideSameDay;
    }

    /**
     * Set hidden
     *
     * @param boolean $hidden
     * @return News
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get hidden
     *
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Set typeClone
     *
     * @param string $typeClone
     * @return $this
     */
    public function setTypeClone($typeClone)
    {
        $this->typeClone = $typeClone;

        return $this;
    }

    /**
     * Get typeClone
     *
     * @return string
     */
    public function getTypeClone()
    {
        return $this->typeClone;
    }

    /**
     * Set oldNewsId
     *
     * @param integer $oldNewsId
     * @return $this
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
     * @return $this
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

    /**
     * Set mobileDisplay
     *
     * @param string $mobileDisplay
     * @return $this
     */
    public function setMobileDisplay($mobileDisplay)
    {
        $this->mobileDisplay = $mobileDisplay;

        return $this;
    }

    /**
     * Get mobileDisplay
     *
     * @return string
     */
    public function getMobileDisplay()
    {
        return $this->mobileDisplay;
    }


    /**
     * @return bool
     */
    public function isDisplayedOnCorpoHome()
    {
        return $this->displayedOnCorpoHome;
    }

    /**
     * @param bool $displayedOnCorpoHome
     * @return $this
     */
    public function setDisplayedOnCorpoHome($displayedOnCorpoHome)
    {
        $this->displayedOnCorpoHome = $displayedOnCorpoHome;
        return $this;
    }
}

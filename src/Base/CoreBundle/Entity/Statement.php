<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
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
abstract class Statement implements TranslateMainInterface
{
    use Time;
    use Seo;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $id;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     *
     * @Groups({"statement_list", "statement_show"})
     * @Assert\NotNull()
     */
    private $theme;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="statements")
     */
    private $festival;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="sliderStatement")
     */
    private $homepage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $displayedHome;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $displayedMobile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $signature;

    /**
     * @var StatementTag
     *
     * @ORM\OneToMany(targetEntity="StatementTag", mappedBy="statement", cascade={"persist"})
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="StatementStatementAssociated", mappedBy="statement", cascade={"persist"})
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $associatedStatement;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $associatedFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $associatedEvent;

    /**
     * @ORM\OneToMany(targetEntity="StatementFilmProjectionAssociated", mappedBy="statement", cascade={"persist"})
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $associatedProjections;

    /**
     * @ORM\OneToMany(targetEntity="StatementFilmFilmAssociated", mappedBy="statement", cascade={"persist"})
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $associatedFilms;

    /**
     * @var StatementWidget
     *
     * @ORM\OneToMany(targetEntity="StatementWidget", mappedBy="statement", cascade={"persist"})
     *
     * @ORM\OrderBy({"position" = "ASC"})
     * @Groups({"statement_list", "statement_show"})
     */
    private $widgets;

    /**
     * @var Site
     *
     * @ORM\ManyToMany(targetEntity="Site")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $sites;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     * @Groups({"web_tv_list", "web_tv_show"})
     */
    private $publishEndedAt;

    /**
     * ArrayCollection
     *
     * @Groups({"statement_list", "statement_show"})
     */
    protected $translations;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $createdBy;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $updatedBy;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    public static function getTypes()
    {
        return array(
            'Base\CoreBundle\Entity\StatementArticle' => 'article',
            'Base\CoreBundle\Entity\StatementAudio' => 'audio',
            'Base\CoreBundle\Entity\StatementImage' => 'image',
            'Base\CoreBundle\Entity\StatementVideo' => 'video'
        );
    }

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"statement_list", "statement_show"})
     */
    public function getStatementType()
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
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\StatementWidget $widgets
     * @return StatementArticleTranslation
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
     * @return Statement
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
     * @return Statement
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
     * @return StatementArticleTranslation
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
     */
    public function addAssociatedNew(\Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement)
    {
        $this->associatedStatement[] = $associatedStatement;

        return $this;
    }

    /**
     * Remove associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement
     */
    public function removeAssociatedNew(\Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement)
    {
        $this->associatedStatement->removeElement($associatedStatement);
    }


    /**
     * Add associatedStatement
     *
     * @param \Base\CoreBundle\Entity\StatementStatementAssociated $associatedStatement
     * @return Statement
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociatedStatement()
    {
        return $this->associatedStatement;
    }

    /**
     * Set associatedFilm
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $associatedFilm
     * @return Statement
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
     * @return Statement
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
     * @return Statement
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
     * @return Statement
     */
    public function addAssociatedFilm(\Base\CoreBundle\Entity\StatementFilmFilmAssociated $associatedFilms)
    {
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
     * @return Statement
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
     * @return Statement
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
}

<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

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
abstract class Statement
{
    use TranslationByLocale;
    use Time;

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
     * @var StatementLock
     *
     * @ORM\OneToMany(targetEntity="StatementLock", mappedBy="statement")
     */
    private $locks;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":0})
     */
    private $translate;

    /**
     * @var StatementTheme
     *
     * @ORM\ManyToOne(targetEntity="StatementTheme")
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $theme;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_ended_at", type="datetime", nullable=true)
     *
     * @Groups({"statement_list", "statement_show"})
     */
    private $publishEndedAt;

    /**
     * @var Homepage
     *
     * @ORM\ManyToOne(targetEntity="Homepage", inversedBy="sliderStatements")
     */
    private $homepage;

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
    private $associations;

    /**
     * @var StatementWidget
     *
     * @ORM\OneToMany(targetEntity="StatementWidget", mappedBy="statement", cascade={"persist"})
     *
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
     * ArrayCollection
     *
     * @Groups({"statement_list", "statement_show"})
     */
    protected $translations;


    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * Set translate
     *
     * @param boolean $translate
     * @return Statement
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;

        return $this;
    }

    /**
     * Get translate
     *
     * @return boolean 
     */
    public function getTranslate()
    {
        return $this->translate;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Statement
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\StatementTheme $theme
     * @return Statement
     */
    public function setTheme(\Base\CoreBundle\Entity\StatementTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\StatementTheme 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Add widgets
     *
     * @param \Base\CoreBundle\Entity\StatementWidget $widgets
     * @return Statement
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
     * Add locks
     *
     * @param \Base\CoreBundle\Entity\StatementLock $locks
     * @return Statement
     */
    public function addLock(\Base\CoreBundle\Entity\StatementLock $locks)
    {
        $this->locks[] = $locks;

        return $this;
    }

    /**
     * Remove locks
     *
     * @param \Base\CoreBundle\Entity\StatementLock $locks
     */
    public function removeLock(\Base\CoreBundle\Entity\StatementLock $locks)
    {
        $this->locks->removeElement($locks);
    }

    /**
     * Get locks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocks()
    {
        return $this->locks;
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
     * Add associations
     *
     * @param \Base\CoreBundle\Entity\StatementStatementAssociated $associations
     * @return Statement
     */
    public function addAssociation(\Base\CoreBundle\Entity\StatementStatementAssociated $associations)
    {
        $this->associations[] = $associations;

        return $this;
    }

    /**
     * Remove associations
     *
     * @param \Base\CoreBundle\Entity\StatementStatementAssociated $associations
     */
    public function removeAssociation(\Base\CoreBundle\Entity\StatementStatementAssociated $associations)
    {
        $this->associations->removeElement($associations);
    }

    /**
     * Get associations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * Add sites
     *
     * @param \Base\CoreBundle\Entity\Site $sites
     * @return Statement
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
}

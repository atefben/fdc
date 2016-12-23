<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldNewsFeed
 *
 * @ORM\Table(name="old_news_feed")
 * @ORM\Entity
 */
class OldNewsFeed
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_online", type="integer", nullable=true)
     */
    protected $isOnline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_date", type="datetime", nullable=true)
     */
    protected $publicationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="unpublication_date", type="datetime", nullable=true)
     */
    protected $unpublicationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    protected $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
    protected $dateModification;

    /**
     * @var integer
     *
     * @ORM\Column(name="view_on_dashboard", type="integer", nullable=false)
     */
    protected $viewOnDashboard;

    /**
     * @var integer
     *
     * @ORM\Column(name="pin_on_dashboard", type="integer", nullable=false)
     */
    protected $pinOnDashboard;

    /**
     * @var integer
     *
     * @ORM\Column(name="dashboard_priority", type="integer", nullable=false)
     */
    protected $dashboardPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="translation_status", type="integer", nullable=false)
     */
    protected $translationStatus;



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
     * Set isOnline
     *
     * @param integer $isOnline
     * @return OldNewsFeed
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline
     *
     * @return integer 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return OldNewsFeed
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set unpublicationDate
     *
     * @param \DateTime $unpublicationDate
     * @return OldNewsFeed
     */
    public function setUnpublicationDate($unpublicationDate)
    {
        $this->unpublicationDate = $unpublicationDate;

        return $this;
    }

    /**
     * Get unpublicationDate
     *
     * @return \DateTime 
     */
    public function getUnpublicationDate()
    {
        return $this->unpublicationDate;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return OldNewsFeed
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     * @return OldNewsFeed
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime 
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set viewOnDashboard
     *
     * @param integer $viewOnDashboard
     * @return OldNewsFeed
     */
    public function setViewOnDashboard($viewOnDashboard)
    {
        $this->viewOnDashboard = $viewOnDashboard;

        return $this;
    }

    /**
     * Get viewOnDashboard
     *
     * @return integer 
     */
    public function getViewOnDashboard()
    {
        return $this->viewOnDashboard;
    }

    /**
     * Set pinOnDashboard
     *
     * @param integer $pinOnDashboard
     * @return OldNewsFeed
     */
    public function setPinOnDashboard($pinOnDashboard)
    {
        $this->pinOnDashboard = $pinOnDashboard;

        return $this;
    }

    /**
     * Get pinOnDashboard
     *
     * @return integer 
     */
    public function getPinOnDashboard()
    {
        return $this->pinOnDashboard;
    }

    /**
     * Set dashboardPriority
     *
     * @param integer $dashboardPriority
     * @return OldNewsFeed
     */
    public function setDashboardPriority($dashboardPriority)
    {
        $this->dashboardPriority = $dashboardPriority;

        return $this;
    }

    /**
     * Get dashboardPriority
     *
     * @return integer 
     */
    public function getDashboardPriority()
    {
        return $this->dashboardPriority;
    }

    /**
     * Set translationStatus
     *
     * @param integer $translationStatus
     * @return OldNewsFeed
     */
    public function setTranslationStatus($translationStatus)
    {
        $this->translationStatus = $translationStatus;

        return $this;
    }

    /**
     * Get translationStatus
     *
     * @return integer 
     */
    public function getTranslationStatus()
    {
        return $this->translationStatus;
    }
}

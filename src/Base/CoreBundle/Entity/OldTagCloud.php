<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldTagCloud
 *
 * @ORM\Table(name="old_tag_cloud", indexes={@ORM\Index(name="pm_pubdate", columns={"publication_date"})})
 * @ORM\Entity
 */
class OldTagCloud
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
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    protected $priority;

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
     * @return OldTagCloud
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
     * Set priority
     *
     * @param integer $priority
     * @return OldTagCloud
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return OldTagCloud
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
     * @return OldTagCloud
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
     * @return OldTagCloud
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
     * @return OldTagCloud
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
     * @return OldTagCloud
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
     * @return OldTagCloud
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
     * @return OldTagCloud
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
     * @return OldTagCloud
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

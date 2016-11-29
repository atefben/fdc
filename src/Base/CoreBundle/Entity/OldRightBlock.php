<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldRightBlock
 *
 * @ORM\Table(name="old_right_block", indexes={@ORM\Index(name="right_block_type_id", columns={"right_block_type_id"})})
 * @ORM\Entity
 */
class OldRightBlock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="right_block_type_id", type="integer", nullable=false)
     */
    private $rightBlockTypeId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="page_shape_id", type="boolean", nullable=true)
     */
    private $pageShapeId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    private $locked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="view_on_dashboard", type="integer", nullable=false)
     */
    private $viewOnDashboard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean", nullable=true)
     */
    private $isOnline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="pin_on_dashboard", type="integer", nullable=false)
     */
    private $pinOnDashboard;

    /**
     * @var integer
     *
     * @ORM\Column(name="dashboard_priority", type="integer", nullable=false)
     */
    private $dashboardPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="translation_status", type="integer", nullable=false)
     */
    private $translationStatus;



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
     * Set rightBlockTypeId
     *
     * @param integer $rightBlockTypeId
     * @return OldRightBlock
     */
    public function setRightBlockTypeId($rightBlockTypeId)
    {
        $this->rightBlockTypeId = $rightBlockTypeId;

        return $this;
    }

    /**
     * Get rightBlockTypeId
     *
     * @return integer 
     */
    public function getRightBlockTypeId()
    {
        return $this->rightBlockTypeId;
    }

    /**
     * Set pageShapeId
     *
     * @param boolean $pageShapeId
     * @return OldRightBlock
     */
    public function setPageShapeId($pageShapeId)
    {
        $this->pageShapeId = $pageShapeId;

        return $this;
    }

    /**
     * Get pageShapeId
     *
     * @return boolean 
     */
    public function getPageShapeId()
    {
        return $this->pageShapeId;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     * @return OldRightBlock
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldRightBlock
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set viewOnDashboard
     *
     * @param integer $viewOnDashboard
     * @return OldRightBlock
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
     * Set isOnline
     *
     * @param boolean $isOnline
     * @return OldRightBlock
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline
     *
     * @return boolean 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return OldRightBlock
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return OldRightBlock
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return OldRightBlock
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
     * Set pinOnDashboard
     *
     * @param integer $pinOnDashboard
     * @return OldRightBlock
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
     * @return OldRightBlock
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
     * @return OldRightBlock
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

<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSyncClassJob
 *
 * @ORM\Table(name="old_sync_class_job", indexes={@ORM\Index(name="sync_class_job_FI_1", columns={"sync_job_id"}), @ORM\Index(name="pm_class_name", columns={"class_name", "start_time"})})
 * @ORM\Entity
 */
class OldSyncClassJob
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sync_class_job_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $syncClassJobId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sync_job_id", type="integer", nullable=true)
     */
    protected $syncJobId;

    /**
     * @var string
     *
     * @ORM\Column(name="class_name", type="string", length=255, nullable=false)
     */
    protected $className;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_count", type="integer", nullable=false)
     */
    protected $updateCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_deleted_pk", type="integer", nullable=false)
     */
    protected $lastDeletedPk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_deleted_time", type="datetime", nullable=true)
     */
    protected $lastDeletedTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_updated_pk", type="integer", nullable=false)
     */
    protected $lastUpdatedPk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated_time", type="datetime", nullable=true)
     */
    protected $lastUpdatedTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="delete_count", type="integer", nullable=false)
     */
    protected $deleteCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=false)
     */
    protected $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true)
     */
    protected $endTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="completed", type="integer", nullable=true)
     */
    protected $completed;



    /**
     * Get syncClassJobId
     *
     * @return integer 
     */
    public function getSyncClassJobId()
    {
        return $this->syncClassJobId;
    }

    /**
     * Set syncJobId
     *
     * @param integer $syncJobId
     * @return OldSyncClassJob
     */
    public function setSyncJobId($syncJobId)
    {
        $this->syncJobId = $syncJobId;

        return $this;
    }

    /**
     * Get syncJobId
     *
     * @return integer 
     */
    public function getSyncJobId()
    {
        return $this->syncJobId;
    }

    /**
     * Set className
     *
     * @param string $className
     * @return OldSyncClassJob
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * Get className
     *
     * @return string 
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Set updateCount
     *
     * @param integer $updateCount
     * @return OldSyncClassJob
     */
    public function setUpdateCount($updateCount)
    {
        $this->updateCount = $updateCount;

        return $this;
    }

    /**
     * Get updateCount
     *
     * @return integer 
     */
    public function getUpdateCount()
    {
        return $this->updateCount;
    }

    /**
     * Set lastDeletedPk
     *
     * @param integer $lastDeletedPk
     * @return OldSyncClassJob
     */
    public function setLastDeletedPk($lastDeletedPk)
    {
        $this->lastDeletedPk = $lastDeletedPk;

        return $this;
    }

    /**
     * Get lastDeletedPk
     *
     * @return integer 
     */
    public function getLastDeletedPk()
    {
        return $this->lastDeletedPk;
    }

    /**
     * Set lastDeletedTime
     *
     * @param \DateTime $lastDeletedTime
     * @return OldSyncClassJob
     */
    public function setLastDeletedTime($lastDeletedTime)
    {
        $this->lastDeletedTime = $lastDeletedTime;

        return $this;
    }

    /**
     * Get lastDeletedTime
     *
     * @return \DateTime 
     */
    public function getLastDeletedTime()
    {
        return $this->lastDeletedTime;
    }

    /**
     * Set lastUpdatedPk
     *
     * @param integer $lastUpdatedPk
     * @return OldSyncClassJob
     */
    public function setLastUpdatedPk($lastUpdatedPk)
    {
        $this->lastUpdatedPk = $lastUpdatedPk;

        return $this;
    }

    /**
     * Get lastUpdatedPk
     *
     * @return integer 
     */
    public function getLastUpdatedPk()
    {
        return $this->lastUpdatedPk;
    }

    /**
     * Set lastUpdatedTime
     *
     * @param \DateTime $lastUpdatedTime
     * @return OldSyncClassJob
     */
    public function setLastUpdatedTime($lastUpdatedTime)
    {
        $this->lastUpdatedTime = $lastUpdatedTime;

        return $this;
    }

    /**
     * Get lastUpdatedTime
     *
     * @return \DateTime 
     */
    public function getLastUpdatedTime()
    {
        return $this->lastUpdatedTime;
    }

    /**
     * Set deleteCount
     *
     * @param integer $deleteCount
     * @return OldSyncClassJob
     */
    public function setDeleteCount($deleteCount)
    {
        $this->deleteCount = $deleteCount;

        return $this;
    }

    /**
     * Get deleteCount
     *
     * @return integer 
     */
    public function getDeleteCount()
    {
        return $this->deleteCount;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return OldSyncClassJob
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return OldSyncClassJob
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set completed
     *
     * @param integer $completed
     * @return OldSyncClassJob
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return integer 
     */
    public function getCompleted()
    {
        return $this->completed;
    }
}

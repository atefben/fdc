<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldHomepageBlock
 *
 * @ORM\Table(name="old_homepage_block")
 * @ORM\Entity
 */
class OldHomepageBlock
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
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean", nullable=true)
     */
    protected $isOnline;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_class", type="integer", nullable=true)
     */
    protected $fileClass;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    protected $priority;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;



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
     * @param boolean $isOnline
     * @return OldHomepageBlock
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
     * Set fileClass
     *
     * @param integer $fileClass
     * @return OldHomepageBlock
     */
    public function setFileClass($fileClass)
    {
        $this->fileClass = $fileClass;

        return $this;
    }

    /**
     * Get fileClass
     *
     * @return integer 
     */
    public function getFileClass()
    {
        return $this->fileClass;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return OldHomepageBlock
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldHomepageBlock
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return OldHomepageBlock
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

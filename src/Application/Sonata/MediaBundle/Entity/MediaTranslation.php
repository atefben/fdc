<?php

namespace Application\Sonata\MediaBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schema is in Resources/config/doctrine/MediaTranslation.orm.xml
 */
class MediaTranslation implements OneLocaleInterface
{
    use Translation;
    
    /**
     * @var string
     */
    private $copyright;
    
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;
    
    private $translatable_id;
    
    /** 
     * preUpdate 
     */  
    public function preUpdate()  
    {  
        $this->updatedAt = new \DateTime();  
    }
    
    /** 
     * prePersist 
     */  
    public function prePersist()  
    {  
        $this->createdAt = new \DateTime();  
        $this->updatedAt = new \DateTime();  
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return \DateTime 
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        
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
    
    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     * @return \DateTime 
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return Article
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }
}

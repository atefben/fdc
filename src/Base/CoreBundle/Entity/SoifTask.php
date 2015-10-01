<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SoifTask
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SoifTask
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     */
    protected $endTimestamp;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $taskName;

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
     * Set endTimestamp
     *
     * @param \DateTime $endTimestamp
     * @return SoifTask
     */
    public function setEndTimestamp($endTimestamp)
    {
        $this->endTimestamp = $endTimestamp;

        return $this;
    }

    /**
     * Get endTimestamp
     *
     * @return \DateTime 
     */
    public function getEndTimestamp()
    {
        return $this->endTimestamp;
    }

    /**
     * Set taskName
     *
     * @param string $taskName
     * @return SoifTask
     */
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;

        return $this;
    }

    /**
     * Get taskName
     *
     * @return string 
     */
    public function getTaskName()
    {
        return $this->taskName;
    }
}

<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Base\CoreBundle\Util\SeoMain;
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
 * Guide
 *
 * @ORM\Table()
 * @ORM\InheritanceType("JOINED")
 */
abstract class Guide implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * ArrayCollection
     *
     */
    protected $translations;


    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }
        
        return $string;
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
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     * @return News
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


}

<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SocialGraph
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SocialGraph
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
     * @var date
     *
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $count;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $lastTweetId;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    public function __construct()
    {
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
     * Set date
     *
     * @param \DateTime $date
     * @return SocialGraph
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return SocialGraph
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set lastTweetId
     *
     * @param integer $lastTweetId
     * @return SocialGraph
     */
    public function setLastTweetId($lastTweetId)
    {
        $this->lastTweetId = $lastTweetId;

        return $this;
    }

    /**
     * Get lastTweetId
     *
     * @return integer 
     */
    public function getLastTweetId()
    {
        return $this->lastTweetId;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return SocialGraph
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
}

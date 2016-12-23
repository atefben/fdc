<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFestivalLogo
 *
 * @ORM\Table(name="old_festival_logo")
 * @ORM\Entity
 */
class OldFestivalLogo
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
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    protected $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_online", type="integer", nullable=true)
     */
    protected $isOnline;

    /**
     * @var boolean
     *
     * @ORM\Column(name="display_right_block", type="boolean", nullable=false)
     */
    protected $displayRightBlock;

    /**
     * @var integer
     *
     * @ORM\Column(name="live_tv_mode", type="integer", nullable=false)
     */
    protected $liveTvMode;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return OldFestivalLogo
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set isOnline
     *
     * @param integer $isOnline
     * @return OldFestivalLogo
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
     * Set displayRightBlock
     *
     * @param boolean $displayRightBlock
     * @return OldFestivalLogo
     */
    public function setDisplayRightBlock($displayRightBlock)
    {
        $this->displayRightBlock = $displayRightBlock;

        return $this;
    }

    /**
     * Get displayRightBlock
     *
     * @return boolean 
     */
    public function getDisplayRightBlock()
    {
        return $this->displayRightBlock;
    }

    /**
     * Set liveTvMode
     *
     * @param integer $liveTvMode
     * @return OldFestivalLogo
     */
    public function setLiveTvMode($liveTvMode)
    {
        $this->liveTvMode = $liveTvMode;

        return $this;
    }

    /**
     * Get liveTvMode
     *
     * @return integer 
     */
    public function getLiveTvMode()
    {
        return $this->liveTvMode;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return OldFestivalLogo
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
     * @return OldFestivalLogo
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
}

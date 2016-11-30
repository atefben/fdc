<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldHomepageBlockI18n
 *
 * @ORM\Table(name="old_homepage_block_i18n")
 * @ORM\Entity
 */
class OldHomepageBlockI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $culture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="news_online", type="boolean", nullable=true)
     */
    private $newsOnline;

    /**
     * @var integer
     *
     * @ORM\Column(name="news_priority", type="integer", nullable=true)
     */
    private $newsPriority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cinema_online", type="boolean", nullable=true)
     */
    private $cinemaOnline;

    /**
     * @var integer
     *
     * @ORM\Column(name="cinema_priority", type="integer", nullable=true)
     */
    private $cinemaPriority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="the_wall_online", type="boolean", nullable=true)
     */
    private $theWallOnline;

    /**
     * @var integer
     *
     * @ORM\Column(name="the_wall_priority", type="integer", nullable=true)
     */
    private $theWallPriority;

    /**
     * @var string
     *
     * @ORM\Column(name="the_wall_filename", type="string", length=255, nullable=true)
     */
    private $theWallFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="the_wall_no_video_link", type="string", length=255, nullable=true)
     */
    private $theWallNoVideoLink;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resonances_online", type="boolean", nullable=true)
     */
    private $resonancesOnline;

    /**
     * @var integer
     *
     * @ORM\Column(name="resonances_priority", type="integer", nullable=true)
     */
    private $resonancesPriority;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldHomepageBlockI18n
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set culture
     *
     * @param string $culture
     * @return OldHomepageBlockI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set newsOnline
     *
     * @param boolean $newsOnline
     * @return OldHomepageBlockI18n
     */
    public function setNewsOnline($newsOnline)
    {
        $this->newsOnline = $newsOnline;

        return $this;
    }

    /**
     * Get newsOnline
     *
     * @return boolean 
     */
    public function getNewsOnline()
    {
        return $this->newsOnline;
    }

    /**
     * Set newsPriority
     *
     * @param integer $newsPriority
     * @return OldHomepageBlockI18n
     */
    public function setNewsPriority($newsPriority)
    {
        $this->newsPriority = $newsPriority;

        return $this;
    }

    /**
     * Get newsPriority
     *
     * @return integer 
     */
    public function getNewsPriority()
    {
        return $this->newsPriority;
    }

    /**
     * Set cinemaOnline
     *
     * @param boolean $cinemaOnline
     * @return OldHomepageBlockI18n
     */
    public function setCinemaOnline($cinemaOnline)
    {
        $this->cinemaOnline = $cinemaOnline;

        return $this;
    }

    /**
     * Get cinemaOnline
     *
     * @return boolean 
     */
    public function getCinemaOnline()
    {
        return $this->cinemaOnline;
    }

    /**
     * Set cinemaPriority
     *
     * @param integer $cinemaPriority
     * @return OldHomepageBlockI18n
     */
    public function setCinemaPriority($cinemaPriority)
    {
        $this->cinemaPriority = $cinemaPriority;

        return $this;
    }

    /**
     * Get cinemaPriority
     *
     * @return integer 
     */
    public function getCinemaPriority()
    {
        return $this->cinemaPriority;
    }

    /**
     * Set theWallOnline
     *
     * @param boolean $theWallOnline
     * @return OldHomepageBlockI18n
     */
    public function setTheWallOnline($theWallOnline)
    {
        $this->theWallOnline = $theWallOnline;

        return $this;
    }

    /**
     * Get theWallOnline
     *
     * @return boolean 
     */
    public function getTheWallOnline()
    {
        return $this->theWallOnline;
    }

    /**
     * Set theWallPriority
     *
     * @param integer $theWallPriority
     * @return OldHomepageBlockI18n
     */
    public function setTheWallPriority($theWallPriority)
    {
        $this->theWallPriority = $theWallPriority;

        return $this;
    }

    /**
     * Get theWallPriority
     *
     * @return integer 
     */
    public function getTheWallPriority()
    {
        return $this->theWallPriority;
    }

    /**
     * Set theWallFilename
     *
     * @param string $theWallFilename
     * @return OldHomepageBlockI18n
     */
    public function setTheWallFilename($theWallFilename)
    {
        $this->theWallFilename = $theWallFilename;

        return $this;
    }

    /**
     * Get theWallFilename
     *
     * @return string 
     */
    public function getTheWallFilename()
    {
        return $this->theWallFilename;
    }

    /**
     * Set theWallNoVideoLink
     *
     * @param string $theWallNoVideoLink
     * @return OldHomepageBlockI18n
     */
    public function setTheWallNoVideoLink($theWallNoVideoLink)
    {
        $this->theWallNoVideoLink = $theWallNoVideoLink;

        return $this;
    }

    /**
     * Get theWallNoVideoLink
     *
     * @return string 
     */
    public function getTheWallNoVideoLink()
    {
        return $this->theWallNoVideoLink;
    }

    /**
     * Set resonancesOnline
     *
     * @param boolean $resonancesOnline
     * @return OldHomepageBlockI18n
     */
    public function setResonancesOnline($resonancesOnline)
    {
        $this->resonancesOnline = $resonancesOnline;

        return $this;
    }

    /**
     * Get resonancesOnline
     *
     * @return boolean 
     */
    public function getResonancesOnline()
    {
        return $this->resonancesOnline;
    }

    /**
     * Set resonancesPriority
     *
     * @param integer $resonancesPriority
     * @return OldHomepageBlockI18n
     */
    public function setResonancesPriority($resonancesPriority)
    {
        $this->resonancesPriority = $resonancesPriority;

        return $this;
    }

    /**
     * Get resonancesPriority
     *
     * @return integer 
     */
    public function getResonancesPriority()
    {
        return $this->resonancesPriority;
    }
}

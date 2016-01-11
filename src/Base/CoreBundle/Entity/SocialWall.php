<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Base\CoreBundle\Interfaces\SocialWallInterface;
use Base\CoreBundle\Util\Time;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SocialWall
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SocialWall implements SocialWallInterface
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $network;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $enabledMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $enabledDesktop;

    /**
     * @var boolean
     *
     * @ORM\Column(type="string")
     */
    protected $tags;

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
     * Set url
     *
     * @param string $url
     * @return SocialWall
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set network
     *
     * @param integer $network
     * @return SocialWall
     */
    public function setNetwork($network)
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get network
     *
     * @return integer 
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return SocialWall
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

    /**
     * Set enabledMobile
     *
     * @param boolean $enabledMobile
     * @return SocialWall
     */
    public function setEnabledMobile($enabledMobile)
    {
        $this->enabledMobile = $enabledMobile;

        return $this;
    }

    /**
     * Get enabledMobile
     *
     * @return boolean 
     */
    public function getEnabledMobile()
    {
        return $this->enabledMobile;
    }

    /**
     * Set enabledDesktop
     *
     * @param boolean $enabledDesktop
     * @return SocialWall
     */
    public function setEnabledDesktop($enabledDesktop)
    {
        $this->enabledDesktop = $enabledDesktop;

        return $this;
    }

    /**
     * Get enabledDesktop
     *
     * @return boolean 
     */
    public function getEnabledDesktop()
    {
        return $this->enabledDesktop;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return SocialWall
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }
}

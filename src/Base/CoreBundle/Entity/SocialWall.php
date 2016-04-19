<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use Base\CoreBundle\Interfaces\SocialWallInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SocialWallNetworks;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SocialWall
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\SocialWallRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class SocialWall implements SocialWallInterface
{
    use Time;
    use SocialWallNetworks;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"social_wall_list"})
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"social_wall_list"})
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(type="date")
     * @Groups({"social_wall_list"})
     */
    protected $date;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @Groups({"social_wall_list"})
     */
    protected $network;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"social_wall_list"})
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"social_wall_list"})
     */
    protected $message;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     * @Groups({"social_wall_list"})
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
     * @Groups({"social_wall_list"})
     */
    protected $tags;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var boolean
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $maxIdTwitter;

    /**
     * @var boolean
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $tumblrId;

    /**
     * @var boolean
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $maxIdInstagram;

    public function __construct()
    {
    }

    /**
     * @VirtualProperty()
     * @Groups({"social_wall_list"})
     * @return mixed
     */
    public function getNetworkName()
    {
        $networks = array('twitter', 'instagram', 'tumblr');

        return $networks[$this->network];
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

    /**
     * Set content
     *
     * @param string $content
     * @return SocialWall
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return SocialWall
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set maxIdTwitter
     *
     * @param string $maxIdTwitter
     * @return SocialWall
     */
    public function setMaxIdTwitter($maxIdTwitter)
    {
        $this->maxIdTwitter = $maxIdTwitter;

        return $this;
    }

    /**
     * Get maxIdTwitter
     *
     * @return string 
     */
    public function getMaxIdTwitter()
    {
        return $this->maxIdTwitter;
    }

    /**
     * Set maxIdInstagram
     *
     * @param string $maxIdInstagram
     * @return SocialWall
     */
    public function setMaxIdInstagram($maxIdInstagram)
    {
        $this->maxIdInstagram = $maxIdInstagram;

        return $this;
    }

    /**
     * Get maxIdInstagram
     *
     * @return string 
     */
    public function getMaxIdInstagram()
    {
        return $this->maxIdInstagram;
    }
    

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return SocialWall
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
     * Set tumblrId
     *
     * @param string $tumblrId
     * @return SocialWall
     */
    public function setTumblrId($tumblrId)
    {
        $this->tumblrId = $tumblrId;

        return $this;
    }

    /**
     * Get tumblrId
     *
     * @return string 
     */
    public function getTumblrId()
    {
        return $this->tumblrId;
    }
}

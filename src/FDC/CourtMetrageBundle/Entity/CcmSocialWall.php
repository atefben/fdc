<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Util\Time;

/**
 * CcmSocialWall
 * @ORM\Table(name="ccm_social_wall")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmSocialWallRepository")
 */
class CcmSocialWall
{
    use Time;

    const NETWORK_TWITTER = 0;
    const NETWORK_INSTAGRAM  = 1;

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
     * @var string
     *
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $network;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $message;

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
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $content;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\FilmFestival")
     */
    protected $festival;

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
    protected $maxIdInstagram;

    public static function getNetworks(){
        return array(
            self::NETWORK_TWITTER => 'form.social_wall.twitter',
            self::NETWORK_INSTAGRAM => 'form.social_wall.instagram'
        );
    }

    /**
     * @return mixed
     */
    public function getNetworkName()
    {
        $networks = array('twitter', 'instagram');

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
     * @param $url
     *
     * @return $this
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
     * @param $network
     *
     * @return $this
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
     * @param FilmFestival|null $festival
     *
     * @return $this
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
     * @param $enabledDesktop
     *
     * @return $this
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
     * @param $tags
     *
     * @return $this
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
     * @param $content
     *
     * @return $this
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
     * @param $message
     *
     * @return $this
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

        return wordwrap($this->message, 30, "\n");
    }

    /**
     * @param $maxIdTwitter
     *
     * @return $this
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
     * @param $maxIdInstagram
     *
     * @return $this
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
     * @param $date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
}

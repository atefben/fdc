<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\MediaVideoTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MediaVideoTranslation implements TranslateChildInterface
{
    use Seo;
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;

    const ENCODING_STATE_IN_PROGRESS = 1;
    const ENCODING_STATE_ERROR = 2;
    const ENCODING_STATE_READY = 3;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="parentVideoTranslation", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected $file;

    /**
     * @var AmazonRemoteFile
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\AmazonRemoteFile")
     * @ORM\JoinColumn(name="amazon_remote_file_id", referencedColumnName="id")
     */
    protected $amazonRemoteFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "news_list", "search",
     *     "news_show",
     *     "trailer_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "film_list",
     *     "film_show",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     * @Serializer\Accessor(getter="getEncodeImageAmazonUrl")
     */
    protected $imageAmazonUrl;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    protected $jobWebmState;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    protected $jobMp4State;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $jobMp4Id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $jobWebmId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     */
    protected $mp4Url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "news_list", "search",
     *     "news_show",
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "event_show",
     *     "home",
     *     "orange_video_on_demand",
     *     "search"
     * })
     */
    protected $webmUrl;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @Groups({
     *     "live",
     *     "web_tv_show",
     *     "live",
     *     "home"
     * })
     */
    protected $theme;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $titleHomeCorpo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $introductionHomeCorpo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->state = 1;
    }


    /**
     * getStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getEncodingStates()
    {
        return array(
            self::ENCODING_STATE_IN_PROGRESS => 'form.encoding_state.in_progress',
            self::ENCODING_STATE_ERROR       => 'form.encoding_state.error',
            self::ENCODING_STATE_READY       => 'form.encoding_state.ready',
        );
    }


    /**
     * Set akamaiId
     *
     * @param integer $akamaiId
     * @return $this
     */
    public function setAkamaiId($akamaiId)
    {
        $this->akamaiId = $akamaiId;

        return $this;
    }

    /**
     * Get akamaiId
     *
     * @return integer
     */
    public function getAkamaiId()
    {
        return $this->akamaiId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return $this
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return $this
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

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return $this
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $file->setParentVideoTranslation($this);
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFile()
    {
        if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'admin') === false) {
            return $this->file ? $this->file : $this->amazonRemoteFile;
        } else {
            return $this->file;
        }

    }

    /**
     * Set theme
     *
     * @param \Base\CoreBundle\Entity\Theme $theme
     * @return $this
     */
    public function setTheme(\Base\CoreBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Base\CoreBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set imageAmazonUrl
     *
     * @param string $imageAmazonUrl
     * @return $this
     */
    public function setImageAmazonUrl($imageAmazonUrl)
    {
        $this->imageAmazonUrl = $imageAmazonUrl;

        return $this;
    }

    /**
     * Get imageAmazonUrl
     *
     * @return string
     */
    public function getImageAmazonUrl()
    {
        return $this->imageAmazonUrl;
    }

    /**
     * Get imageAmazonUrl
     *
     * @return string
     */
    public function getEncodeImageAmazonUrl()
    {
        return str_replace(' ', '%20', $this->imageAmazonUrl);
    }


    /**
     * Set webmUrl
     *
     * @param integer $webmUrl
     * @return $this
     */
    public function setWebmURL($webmUrl)
    {
        $this->webmUrl = $webmUrl;

        return $this;
    }

    /**
     * Get webmUrl
     *
     * @return string
     */
    public function getWebmUrl()
    {
        return $this->webmUrl;
    }

    /**
     * Set mp4Url
     *
     * @param string $mp4Url
     * @return $this
     */
    public function setMp4Url($mp4Url)
    {
        $this->mp4Url = $mp4Url;

        return $this;
    }

    /**
     * Get mp4URL
     *
     * @return string
     */
    public function getMp4Url()
    {
        return $this->mp4Url;
    }

    /**
     * Set jobWebmState
     *
     * @param string $jobWebmState
     * @return $this
     */
    public function setJobWebmState($jobWebmState)
    {
        $this->jobWebmState = $jobWebmState;

        return $this;
    }

    /**
     * Get jobWebmState
     *
     * @return integer
     */
    public function getJobWebmState()
    {
        return $this->jobWebmState;
    }

    /**
     * Set jobMp4State
     *
     * @param integer $jobMp4State
     * @return $this
     */
    public function setJobMp4State($jobMp4State)
    {
        $this->jobMp4State = $jobMp4State;

        return $this;
    }

    /**
     * Get jobMp4State
     *
     * @return integer
     */
        public function getJobMp4State()
    {
        return $this->jobMp4State;
    }

    /**
     * Set jobMp4Id
     *
     * @param string $jobMp4Id
     * @return $this
     */
    public function setJobMp4Id($jobMp4Id)
    {
        $this->jobMp4Id = $jobMp4Id;

        return $this;
    }

    /**
     * Get jobMp4Id
     *
     * @return string
     */
    public function getJobMp4Id()
    {
        return $this->jobMp4Id;
    }

    /**
     * Set jobWebmId
     *
     * @param string $jobWebmId
     * @return $this
     */
    public function setJobWebmId($jobWebmId)
    {
        $this->jobWebmId = $jobWebmId;

        return $this;
    }

    /**
     * Get jobWebmId
     *
     * @return string
     */
    public function getJobWebmId()
    {
        return $this->jobWebmId;
    }

    /**
     * Set amazonRemoteFile
     *
     * @param \Base\CoreBundle\Entity\AmazonRemoteFile $amazonRemoteFile
     * @return $this
     */
    public function setAmazonRemoteFile(\Base\CoreBundle\Entity\AmazonRemoteFile $amazonRemoteFile = null)
    {
        $this->amazonRemoteFile = $amazonRemoteFile;

        return $this;
    }

    /**
     * Get amazonRemoteFile
     *
     * @return \Base\CoreBundle\Entity\AmazonRemoteFile
     */
    public function getAmazonRemoteFile()
    {
        return $this->amazonRemoteFile;
    }

    /**
     * Set titleHomeCorpo
     *
     * @param string $titleHomeCorpo
     * @return $this
     */
    public function setTitleHomeCorpo($titleHomeCorpo)
    {
        $this->titleHomeCorpo = $titleHomeCorpo;

        return $this;
    }

    /**
     * Get titleHomeCorpo
     *
     * @return string 
     */
    public function getTitleHomeCorpo()
    {
        return $this->titleHomeCorpo;
    }

    /**
     * Set introductionHomeCorpo
     *
     * @param string $introductionHomeCorpo
     * @return $this
     */
    public function setIntroductionHomeCorpo($introductionHomeCorpo)
    {
        $this->introductionHomeCorpo = $introductionHomeCorpo;

        return $this;
    }

    /**
     * Get introductionHomeCorpo
     *
     * @return string 
     */
    public function getIntroductionHomeCorpo()
    {
        return $this->introductionHomeCorpo;
    }
}

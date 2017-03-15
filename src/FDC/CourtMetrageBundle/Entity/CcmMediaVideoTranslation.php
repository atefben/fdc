<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use JMS\Serializer\Annotation as Serializer;
use Base\CoreBundle\Entity\AmazonRemoteFile;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaVideoTranslation implements TranslateChildInterface
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
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
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
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
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
     */
    protected $mp4Url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $webmUrl;

    /**
     * @var CcmTheme
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmTheme")
     */
    protected $theme;

    /**
     * Constructor
     */
    public function __construct()
    {
    }


    /**
     * getStatuses function.
     *
     * @access public
     * @static
     * @return array
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
     * Set title
     *
     * @param string $title
     * @return CcmMediaVideoTranslation
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return CcmMediaVideoTranslation
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
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
     * @param CcmTheme $theme
     * @return CcmMediaVideoTranslation
     */
    public function setTheme(CcmTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return CcmTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set imageAmazonUrl
     *
     * @param string $imageAmazonUrl
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
     * @return CcmMediaVideoTranslation
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
}

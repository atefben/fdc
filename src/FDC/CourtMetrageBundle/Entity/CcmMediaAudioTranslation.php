<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\AmazonRemoteFile;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaAudioTranslation implements TranslateChildInterface
{
    use Seo;
    use Time;
    use Translation;
    use TranslationChanges;
    use TranslateChild;

    const ENCODING_STATE_IN_PROGRESS = 1;
    const ENCODING_STATE_ERROR = 2;
    const ENCODING_STATE_READY = 3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    protected $jobMp3State;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $jobMp3Id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $mp3Url;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
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
     * Set title
     *
     * @param string $title
     * @return CcmMediaAudioTranslation
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
     * @return CcmMediaAudioTranslation
     */
    public function setFile(Media $file = null)
    {
        $file->setCcmParentAudioTranslation($this);
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
        return $this->file;
    }

    /**
     * Set jobMp3State
     *
     * @param integer $jobMp3State
     * @return CcmMediaAudioTranslation
     */
    public function setJobMp3State($jobMp3State)
    {
        $this->jobMp3State = $jobMp3State;

        return $this;
    }

    /**
     * Get jobMp3State
     *
     * @return integer 
     */
    public function getJobMp3State()
    {
        return $this->jobMp3State;
    }

    /**
     * Set jobMp3Id
     *
     * @param string $jobMp3Id
     * @return CcmMediaAudioTranslation
     */
    public function setJobMp3Id($jobMp3Id)
    {
        $this->jobMp3Id = $jobMp3Id;

        return $this;
    }

    /**
     * Get jobMp3Id
     *
     * @return string 
     */
    public function getJobMp3Id()
    {
        return $this->jobMp3Id;
    }

    /**
     * Set mp3Url
     *
     * @param string $mp3Url
     * @return CcmMediaAudioTranslation
     */
    public function setMp3Url($mp3Url)
    {
        $this->mp3Url = $mp3Url;

        return $this;
    }

    /**
     * Get mp3Url
     *
     * @return string 
     */
    public function getMp3Url()
    {
        return $this->mp3Url;
    }

    /**
     * Set amazonRemoteFile
     *
     * @param \Base\CoreBundle\Entity\AmazonRemoteFile $amazonRemoteFile
     * @return CcmMediaAudioTranslation
     */
    public function setAmazonRemoteFile(AmazonRemoteFile $amazonRemoteFile = null)
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

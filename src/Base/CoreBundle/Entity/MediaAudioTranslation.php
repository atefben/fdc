<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaAudioTranslation implements TranslateChildInterface
{
    use Seo;
    use Time;
    use Translation;
    use TranslateChild;

    const ENCODING_STATE_IN_PROGRESS = 1;
    const ENCODING_STATE_ERROR = 2;
    const ENCODING_STATE_READY = 3;

    /**
     * @var string
     *
     * @Groups({"news_list", "news_show"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $jobWebmState;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $jobMp4State;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $jobMp4Id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $jobWebmId;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="parentAudioTranslation", cascade={"persist"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    private $file;

    /**
     * Set title
     *
     * @param string $title
     * @return MediaAudioTranslation
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
     * @return MediaAudioTranslation
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $file->setParentAudioTranslation($this);
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
     * Set jobWebmState
     *
     * @param integer $jobWebmState
     * @return MediaAudioTranslation
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
     * @return MediaAudioTranslation
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
     * @return MediaAudioTranslation
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
     * @return MediaAudioTranslation
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
}

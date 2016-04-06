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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"news_list", "news_show", "film_show", "event_show", "home"})
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $jobMp3State;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $jobMp3Id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"news_list", "news_show", "film_show", "event_show", "home"})
     */
    private $mp3Url;

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
     * Set jobMp3State
     *
     * @param integer $jobMp3State
     * @return MediaAudioTranslation
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
     * @return MediaAudioTranslation
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
     * @return MediaAudioTranslation
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
}

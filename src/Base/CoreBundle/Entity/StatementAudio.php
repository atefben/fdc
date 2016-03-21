<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * StatementAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementAudio extends Statement
{
    use Translatable;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show"})
     */
    private $header;

    /**
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="MediaAudio", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show"})
     * @Assert\NotNull()
     */
    private $audio;


    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
        }

        return $string;
    }

    public function getNewsFormat()
    {
        return 'audios';
    }

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return StatementArticle
     */
    public function setHeader(MediaImage $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return MediaImage
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set audio
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $audio
     * @return StatementAudio
     */
    public function setAudio(\Base\CoreBundle\Entity\MediaAudio $audio = null)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return \Base\CoreBundle\Entity\MediaAudio
     */
    public function getAudio()
    {
        return $this->audio;
    }
}

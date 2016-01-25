<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * InfoAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class InfoAudio extends Info
{
    use Translatable;

    /**
     * @var MediaAudio
     *
     * @ORM\ManyToOne(targetEntity="MediaAudio")
     *
     * @Groups({"news_list", "news_show"})
     */
    private $audio;


    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    /**
     * Set audio
     *
     * @param \Base\CoreBundle\Entity\MediaAudio $audio
     * @return InfoAudio
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

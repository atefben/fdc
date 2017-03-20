<?php

namespace FDC\CourtMetrageBundle\Entity;


use Base\CoreBundle\Util\Time;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmNewsAudio
 *
 * @ORM\Table(name="ccm_news_audio")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsAudio extends CcmNews
{
    use Translatable;
    use TruncatePro;

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $header;

    /**
     * @var CcmMediaAudio
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaAudio")
     *
     * @Groups({"news_list", "search", "news_show", "home"})
     * @Assert\NotNull()
     */
    protected $audio;


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
     * @param CcmMediaImage $header
     * @return CcmNewsAudio
     */
    public function setHeader(CcmMediaImage $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return CcmMediaImage
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set audio
     *
     * @param CcmMediaAudio $audio
     * @return CcmNewsAudio
     */
    public function setAudio(CcmMediaAudio $audio = null)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return CcmMediaAudio 
     */
    public function getAudio()
    {
        return $this->audio;
    }
}

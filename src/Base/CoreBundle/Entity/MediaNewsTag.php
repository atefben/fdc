<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaNewsTag
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaNewsTag
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="tags")
     */
    protected $media;

    /**
     * @var NewsTag
     *
     * @ORM\ManyToOne(targetEntity="NewsTag")
     */
    protected $tag;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId() && $this->getTags()) {
            $translation = $this->getTags()->findTranslationByLocale('fr');
            if ($translation !== null) {
                return $translation->getName();
            }
        }

        return $string;
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
     * Set media
     *
     * @param \Base\CoreBundle\Entity\Media $media
     * @return MediaNewsTag
     */
    public function setMedia(\Base\CoreBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Base\CoreBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set tag
     *
     * @param \Base\CoreBundle\Entity\NewsTag $tag
     * @return MediaNewsTag
     */
    public function setTag(\Base\CoreBundle\Entity\NewsTag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Base\CoreBundle\Entity\NewsTag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}

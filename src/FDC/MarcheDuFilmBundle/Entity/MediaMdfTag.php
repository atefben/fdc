<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * MediaMdfTag
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaMdfTag
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
     * @var MediaMdf
     *
     * @ORM\ManyToOne(targetEntity="MediaMdf", inversedBy="tags")
     */
    protected $media;

    /**
     * @var \Base\CoreBundle\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="\Base\CoreBundle\Entity\Tag")
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
     * @param \FDC\MarcheDuFilmBundle\Entity\MediaMdf $media
     * @return MediaMdf
     */
    public function setMedia(\FDC\MarcheDuFilmBundle\Entity\MediaMdf $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MediaMdf 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set tag
     *
     * @param \Base\CoreBundle\Entity\Tag $tag
     * @return MediaMdfTag
     */
    public function setTag(\Base\CoreBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Base\CoreBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}

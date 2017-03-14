<?php

namespace FDC\CourtMetrageBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;

/**
 * CcmMediaTag
 *
 * @ORM\Table(name="ccm_media_tag")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmMediaTag
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
     * @var CcmMedia
     *
     * @ORM\ManyToOne(targetEntity="CcmMedia", inversedBy="tags")
     */
    protected $media;

    /**
     * @var CcmTag
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmTag")
     */
    protected $tag;

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
     * @param CcmMedia $media
     * @return CcmMediaTag
     */
    public function setMedia(CcmMedia $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return CcmMedia
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set tag
     *
     * @param CcmTag $tag
     * @return CcmMediaTag
     */
    public function setTag(CcmTag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return CcmTag
     */
    public function getTag()
    {
        return $this->tag;
    }
}

<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\TruncatePro;
use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * InfoImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class InfoImage extends Info
{
    use Translatable;
    use TruncatePro;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"news_list", "search", "news_show", "home"})
     */
    protected $header;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     * @Assert\NotNull()
     */
    protected $gallery;

    public function getNewsFormat()
    {
        return 'photos';
    }

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return InfoArticle
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
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return InfoImage
     */
    public function setGallery(\Base\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}

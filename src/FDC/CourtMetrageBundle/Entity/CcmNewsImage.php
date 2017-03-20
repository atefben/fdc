<?php

namespace FDC\CourtMetrageBundle\Entity;


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
 * CcmNewsImage
 *
 * @ORM\Table(name="ccm_news_image")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsImage extends CcmNews
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmGallery")
     * @Groups({"news_list", "search", "news_show", "home"})
     *
     * @Assert\NotNull()
     */
    protected $gallery;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
        }
        
        return $string;
    }

    public function getNewsFormat()
    {
        return 'photos';
    }

    /**
     * Set header
     *
     * @param CcmMediaImage $header
     * @return CcmNewsArticle
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
     * Set gallery
     *
     * @param CcmGallery $gallery
     * @return CcmNewsImage
     */
    public function setGallery(CcmGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return CcmGallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}

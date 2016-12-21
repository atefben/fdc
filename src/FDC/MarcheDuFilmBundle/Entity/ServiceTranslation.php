<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ServiceTranslation
 *
 * @ORM\Table(name="service_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceTranslation implements TranslateChildInterface
{
    use Seo;
    use TranslateChild;
    use Time;
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subTitle", type="string", length=255, nullable=true)
     */
    protected $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="header", type="text", nullable=true)
     */
    protected $header;

    /**
     * @var string
     *
     * @ORM\Column(name="show_content_block", type="boolean", nullable=true)
     */
    protected $showContentBlock = false;

    /**
     * @var string
     *
     * @ORM\Column(name="content_block_tile", type="string", nullable=true)
     */
    protected $contentBlockTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="content_block_body", type="text", nullable=true)
     */
    protected $contentBlockBody;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=true)
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * Set title
     *
     * @param string $title
     * @return ServiceTranslation
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
     * Set subTitle
     *
     * @param string $subTitle
     * @return ServiceTranslation
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Get subTitle
     *
     * @return string 
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Set header
     *
     * @param string $header
     * @return ServiceTranslation
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ServiceTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set showContentBlock
     *
     * @param boolean $showContentBlock
     * @return ServiceTranslation
     */
    public function setShowContentBlock($showContentBlock)
    {
        $this->showContentBlock = $showContentBlock;

        return $this;
    }

    /**
     * Get showContentBlock
     *
     * @return boolean 
     */
    public function getShowContentBlock()
    {
        return $this->showContentBlock;
    }

    /**
     * Set contentBlockTitle
     *
     * @param string $contentBlockTitle
     * @return ServiceTranslation
     */
    public function setContentBlockTitle($contentBlockTitle)
    {
        $this->contentBlockTitle = $contentBlockTitle;

        return $this;
    }

    /**
     * Get contentBlockTitle
     *
     * @return string 
     */
    public function getContentBlockTitle()
    {
        return $this->contentBlockTitle;
    }

    /**
     * Set contentBlockBody
     *
     * @param string $contentBlockBody
     * @return ServiceTranslation
     */
    public function setContentBlockBody($contentBlockBody)
    {
        $this->contentBlockBody = $contentBlockBody;

        return $this;
    }

    /**
     * Get contentBlockBody
     *
     * @return string 
     */
    public function getContentBlockBody()
    {
        return $this->contentBlockBody;
    }
}

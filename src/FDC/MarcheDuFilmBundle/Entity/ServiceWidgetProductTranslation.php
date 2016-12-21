<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceWidgetProductTranslation
 *
 * @ORM\Table(name="service_widget_product_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceWidgetProductTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidgetProductTranslation
{
    use Translation;
    use TranslationChanges;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subTitle", type="string", length=255, nullable=true)
     */
    private $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="toggledBody", type="text", nullable=true)
     */
    private $toggledBody;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * Set title
     *
     * @param string $title
     * @return ServiceWidgetProductTranslation
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
     * @return ServiceWidgetProductTranslation
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
     * Set body
     *
     * @param string $body
     * @return ServiceWidgetProductTranslation
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set toggledBody
     *
     * @param string $toggledBody
     * @return ServiceWidgetProductTranslation
     */
    public function setToggledBody($toggledBody)
    {
        $this->toggledBody = $toggledBody;

        return $this;
    }

    /**
     * Get toggledBody
     *
     * @return string 
     */
    public function getToggledBody()
    {
        return $this->toggledBody;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return ServiceWidgetProductTranslation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}

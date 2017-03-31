<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * ContactTranslation
 * @ORM\Table(name="mdf_contact_translation")
 * @ORM\Entity
 */
class ContactTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $information;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $seeMoreUrl;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * @param $subTitle
     *
     * @return $this
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param $information
     *
     * @return $this
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeeMoreUrl()
    {
        return $this->seeMoreUrl;
    }

    /**
     * @param $seeMoreUrl
     *
     * @return $this
     */
    public function setSeeMoreUrl($seeMoreUrl)
    {
        $this->seeMoreUrl = $seeMoreUrl;

        return $this;
    }
}

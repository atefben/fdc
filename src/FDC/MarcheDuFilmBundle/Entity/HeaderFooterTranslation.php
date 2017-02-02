<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HeaderFooterTranslation
 * @ORM\Table(name="mdf_header_footer_translation")
 * @ORM\Entity
 */
class HeaderFooterTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $footerFacebookUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $footerTwitterUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $footerYoutubeUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $headerBannerUrl;

    /**
     * @return string
     */
    public function getFooterFacebookUrl()
    {
        return $this->footerFacebookUrl;
    }

    /**
     * @param $footerFacebookUrl
     *
     * @return $this
     */
    public function setFooterFacebookUrl($footerFacebookUrl)
    {
        $this->footerFacebookUrl = $footerFacebookUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getFooterTwitterUrl()
    {
        return $this->footerTwitterUrl;
    }

    /**
     * @param $footerTwitterUrl
     *
     * @return $this
     */
    public function setFooterTwitterUrl($footerTwitterUrl)
    {
        $this->footerTwitterUrl = $footerTwitterUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getFooterYoutubeUrl()
    {
        return $this->footerYoutubeUrl;
    }

    /**
     * @param $footerYoutubeUrl
     *
     * @return $this
     */
    public function setFooterYoutubeUrl($footerYoutubeUrl)
    {
        $this->footerYoutubeUrl = $footerYoutubeUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeaderBannerUrl()
    {
        return $this->headerBannerUrl;
    }

    /**
     * @param $headerBannerUrl
     *
     * @return $this
     */
    public function setHeaderBannerUrl($headerBannerUrl)
    {
        $this->headerBannerUrl = $headerBannerUrl;

        return $this;
    }
}

<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepageSliderTranslation
 * @ORM\Table(name="ccm_homepage_slider_translation")
 * @ORM\Entity
 */
class HomepageSliderTranslation
{
    use Translation;
    use TranslationChanges;

    const SMALL = 'small';
    const MEDIUM= 'medium';
    const LARGE = 'large';

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $whiteTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $goldenTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $buttonLabel;

    /**
     * Get whiteTitle.
     *
     * @return string
     */
    public function getWhiteTitle()
    {
        return $this->whiteTitle;
    }

    /**
     * Set whiteTitle.
     *
     * @param string $whiteTitle
     */
    public function setWhiteTitle($whiteTitle)
    {
        $this->whiteTitle = $whiteTitle;

        return $this;
    }

    /**
     * Get goldenTitle.
     *
     * @return string
     */
    public function getGoldenTitle()
    {
        return $this->goldenTitle;
    }

    /**
     * Set goldenTitle.
     *
     * @param string $goldenTitle
     */
    public function setGoldenTitle($goldenTitle)
    {
        $this->goldenTitle = $goldenTitle;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get buttonLabel.
     *
     * @return string
     */
    public function getButtonLabel()
    {
        return $this->buttonLabel;
    }

    /**
     * Set buttonLabel.
     *
     * @param string $buttonLabel
     */
    public function setButtonLabel($buttonLabel)
    {
        $this->buttonLabel = $buttonLabel;

        return $this;
    }

    /**
     * Get text sizes.
     *
     * @access public
     * @static
     */
    public static function getTextSizes()
    {
        return array(
            self::SMALL => 'form.ccm.size.small',
            self::MEDIUM => 'form.ccm.size.small',
            self::LARGE => 'form.ccm.size.small'
        );
    }
}

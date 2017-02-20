<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepagePushTranslation
 * @ORM\Table(name="ccm_homepage_push_translation")
 * @ORM\Entity
 */
class HomepagePushTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $whiteTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $goldenTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $url;

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
}

<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepageSliderTranslation
 * @ORM\Table(name="ccm_homepage_sejour_translation")
 * @ORM\Entity
 */
class HomepageSejourTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $title1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $title2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $url;

    /**
     * Get title1.
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set title1.
     *
     * @param string $title1
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;

        return $this;
    }

    /**
     * Get title2.
     *
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * Set title2.
     *
     * @param string $title2
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;

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

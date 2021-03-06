<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;
use FDC\CourtMetrageBundle\Repository\HomepageSejourTranslationsRepository;

/**
 * HomepageSliderTranslation
 * @ORM\Table(name="ccm_homepage_sejour_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\HomepageSejourTranslationRepository")
 */
class HomepageSejourTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $button;

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

    /**
     * Get button.
     *
     * @return string
     */
    public function getButton()
    {
        return $this->button;
    }

    /**
     * Set button.
     *
     * @param string $button
     */
    public function setButton($button)
    {
        $this->button = $button;

        return $this;
    }
}

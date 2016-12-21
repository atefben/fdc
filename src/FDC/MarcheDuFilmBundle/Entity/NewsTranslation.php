<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;


/**
 * NewsTranslation
 * @ORM\Table(name="mdf_news_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\NewsTranslationRepository")
 */
class NewsTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $newsTheme;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $newsTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @return string
     */
    public function getNewsTheme()
    {
        return $this->newsTheme;
    }

    /**
     * @param $newsTheme
     *
     * @return $this
     */
    public function setNewsTheme($newsTheme)
    {
        $this->newsTheme = $newsTheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getNewsTitle()
    {
        return $this->newsTitle;
    }

    /**
     * @param $newsTitle
     *
     * @return $this
     */
    public function setNewsTitle($newsTitle)
    {
        $this->newsTitle = $newsTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}

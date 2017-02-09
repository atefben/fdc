<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomeSliderTopTranslation
 * @ORM\Table(name="mdf_homepage_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfHomepageTranslationRepository")
 */
class MdfHomepageTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

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
    protected $servicesCategory;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $servicesTitle;

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

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

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getServicesCategory()
    {
        return $this->servicesCategory;
    }

    /**
     * @param $servicesCategory
     *
     * @return $this
     */
    public function setServicesCategory($servicesCategory)
    {
        $this->servicesCategory = $servicesCategory;

        return $this;
    }

    /**
     * @return string
     */
    public function getServicesTitle()
    {
        return $this->servicesTitle;
    }

    /**
     * @param $servicesTitle
     *
     * @return $this
     */
    public function setServicesTitle($servicesTitle)
    {
        $this->servicesTitle = $servicesTitle;

        return $this;
    }
}

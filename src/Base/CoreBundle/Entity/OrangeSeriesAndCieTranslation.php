<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Seo;

use Base\CoreBundle\Util\Time;

use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\Groups;

/**
 * OrangeSeriesAndCie
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeSeriesAndCieTranslation implements TranslateChildInterface
{
    use TranslateChild;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     * @Groups({"orange_series_and_cie"})
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction", type="text", nullable=true)
     * @Groups({"orange_series_and_cie"})
     */
    protected $introduction;
    
    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Groups({"orange_series_and_cie"})
     */
    protected $slug;

    /**
     * Set title
     *
     * @param string $title
     * @return OrangeSeriesAndCie
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
     * Set introduction
     *
     * @param string $introduction
     * @return OrangeSeriesAndCie
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * Get introduction
     *
     * @return string 
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }
    
    /**
     * Set slug
     *
     * @param string $slug
     * @return Settings
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
}

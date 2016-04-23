<?php

namespace Base\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Sluggable\Util\Urlizer;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * FDCPageLaSelectionCannesClassicsTranslation
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageLaSelectionCannesClassicsTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"classics"})
     *
     */
    private $titleNav;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"classics"})
     *
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"classics"})
     *
     */
    private $hideTitle = false;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Groups({"classics"})
     */
    private $slug;

    /**
     * Set titleNav
     *
     * @param string $titleNav
     * @return FDCPageLaSelectionCannesClassicsTranslation
     */
    public function setTitleNav($titleNav)
    {
        $this->titleNav = $titleNav;

        return $this;
    }

    /**
     * Get titleNav
     *
     * @return string 
     */
    public function getTitleNav()
    {
        return $this->titleNav;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FDCPageLaSelectionCannesClassicsTranslation
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
     * Set slug
     *
     * @param string $slug
     * @return FDCPageLaSelectionCannesClassicsTranslation
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

    /**
     * @return string
     */
    public function getHideTitle()
    {
        return $this->hideTitle;
    }

    /**
     * @param string $hideTitle
     * @return $this
     */
    public function setHideTitle($hideTitle)
    {
        $this->hideTitle = $hideTitle;
        return $this;
    }



}

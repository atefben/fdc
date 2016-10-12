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
 * CorpoWhoAreWeTranslation
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class CorpoWhoAreWeTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
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
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"classics"})
     *
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"classics"})
     *
     */
    private $chapo;

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
     * @return CorpoWhoAreWeTranslation
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
     * @return CorpoWhoAreWeTranslation
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
     * Set hideTitle
     *
     * @param boolean $hideTitle
     * @return CorpoWhoAreWeTranslation
     */
    public function setHideTitle($hideTitle)
    {
        $this->hideTitle = $hideTitle;

        return $this;
    }

    /**
     * Get hideTitle
     *
     * @return boolean 
     */
    public function getHideTitle()
    {
        return $this->hideTitle;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return CorpoWhoAreWeTranslation
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
     * Set content
     *
     * @param string $content
     * @return CorpoWhoAreWeTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set chapo
     *
     * @param string $chapo
     * @return CorpoWhoAreWeTranslation
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * Get chapo
     *
     * @return string 
     */
    public function getChapo()
    {
        return $this->chapo;
    }
}

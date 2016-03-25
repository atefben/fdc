<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Seo;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCCannesClassicsTranslation implements TranslateChildInterface
{
    use Seo;
    use TranslateChild;
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $navTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * Set navTitle
     *
     * @param string $navTitle
     * @return FDCCannesClassicsTranslation
     */
    public function setNavTitle($navTitle)
    {
        $this->navTitle = $navTitle;

        return $this;
    }

    /**
     * Get navTitle
     *
     * @return string 
     */
    public function getNavTitle()
    {
        return $this->navTitle;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FDCCannesClassicsTranslation
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
     * @return FDCCannesClassicsTranslation
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

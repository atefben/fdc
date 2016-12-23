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
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * FDCPageLaSelectionTranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Entity\FDCPageLaSelectionTranslationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FDCPageLaSelectionTranslation implements TranslateChildInterface
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
     *
     */
    protected $overrideName;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"overrideName"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=false, nullable=true)
     */
    protected $slug;

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new DateTime();
    }


    /**
     * Set overrideName
     *
     * @param string $overrideName
     * @return FDCPageLaSelectionTranslation
     */
    public function setOverrideName($overrideName)
    {
        $this->overrideName = $overrideName;

        return $this;
    }

    /**
     * Get overrideName
     *
     * @return string 
     */
    public function getOverrideName()
    {
        return $this->overrideName;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return FDCPageLaSelectionTranslation
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

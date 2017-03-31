<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceTranslation
 *
 * @ORM\Table(name="mdf_service_widget_translation")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\ServiceWidgetTranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceWidgetTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subTitle", type="string", length=255, nullable=true)
     */
    protected $subTitle;

    /**
     * Set title
     *
     * @param string $title
     * @return ServiceTranslation
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
     * Set subTitle
     *
     * @param string $subTitle
     * @return ServiceTranslation
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Get subTitle
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }
}

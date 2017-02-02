<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MdfContentTemplateWidgetVideo
 * @ORM\Table(name="mdf_content_template_widget_video")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContentTemplateWidgetVideoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MdfContentTemplateWidgetVideo extends MdfContentTemplateWidget
{
    use Time;
    use Translatable;

    /**
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="contentTemplateWidgetVideo")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $image;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfTheme")
     * @Assert\NotBlank()
     */
    private $theme;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return MediaMdf
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set theme
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme
     * @return MdfTheme
     */
    public function setTheme(\FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}

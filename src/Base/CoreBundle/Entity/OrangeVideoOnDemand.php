<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrangeProgrammationOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class OrangeVideoOnDemand extends Orange
{
    use Translatable;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    private $header;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     *
     */
    private $video;


    /**
     * @var OrangeWidget
     *
     * @ORM\OneToMany(targetEntity="OrangeWidgetFilmVOD", mappedBy="parent", cascade={"all"}, orphanRemoval=true)
     *
     * @ORM\OrderBy({"section" = "ASC", "position" = "ASC"})
     */
    protected $widgets;

    /**
     * Set video
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $video
     * @return OrangeVideoOnDemand
     */
    public function setVideo(MediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Base\CoreBundle\Entity\MediaVideo
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set header
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $header
     * @return OrangeVideoOnDemand
     */
    public function setHeader(\Base\CoreBundle\Entity\MediaImageSimple $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getHeader()
    {
        return $this->header;
    }

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId() && $this->findTranslationByLocale('fr')) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
            $string = $this->truncate($string, 40, '..."', true);
        }

        return $string;
    }
}

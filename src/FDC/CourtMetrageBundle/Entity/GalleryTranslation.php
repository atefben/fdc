<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * GalleryTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $titleHomeCorpo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     */
    protected $introductionHomeCorpo;

    /**
     * Constructor
     */
    public function __construct()
    {
        
    }

    /**
     * Set titleHomeCorpo
     *
     * @param string $titleHomeCorpo
     * @return GalleryTranslation
     */
    public function setTitleHomeCorpo($titleHomeCorpo)
    {
        $this->titleHomeCorpo = $titleHomeCorpo;

        return $this;
    }

    /**
     * Get titleHomeCorpo
     *
     * @return string 
     */
    public function getTitleHomeCorpo()
    {
        return $this->titleHomeCorpo;
    }

    /**
     * Set introductionHomeCorpo
     *
     * @param string $introductionHomeCorpo
     * @return GalleryTranslation
     */
    public function setIntroductionHomeCorpo($introductionHomeCorpo)
    {
        $this->introductionHomeCorpo = $introductionHomeCorpo;

        return $this;
    }

    /**
     * Get introductionHomeCorpo
     *
     * @return string 
     */
    public function getIntroductionHomeCorpo()
    {
        return $this->introductionHomeCorpo;
    }
}

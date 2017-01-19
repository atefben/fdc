<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * GalleryMdfTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class GalleryMdfTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleHomeCorpo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

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
     * @return GalleryMdfTranslation
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
     * @return GalleryMdfTranslation
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

    /**
     * Set name
     *
     * @param string $name
     * @return GalleryMdf
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

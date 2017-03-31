<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

/**
 * CorpoMovieInscriptionTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoMovieInscriptionTranslation implements TranslateChildInterface
{
    use Time;
    use TranslateChild;
    use Translation;
    use TranslationChanges;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $tabPrefix;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $commonContent;


    /**
     * Set commonContent
     *
     * @param string $commonContent
     * @return CorpoMovieInscriptionTranslation
     */
    public function setCommonContent($commonContent)
    {
        $this->commonContent = $commonContent;

        return $this;
    }

    /**
     * Get commonContent
     *
     * @return string 
     */
    public function getCommonContent()
    {
        return $this->commonContent;
    }


    /**
     * Set tabPrefix
     *
     * @param string $tabPrefix
     * @return CorpoMovieInscriptionTranslation
     */
    public function setTabPrefix($tabPrefix)
    {
        $this->tabPrefix = $tabPrefix;

        return $this;
    }

    /**
     * Get tabPrefix
     *
     * @return string 
     */
    public function getTabPrefix()
    {
        return $this->tabPrefix;
    }
}

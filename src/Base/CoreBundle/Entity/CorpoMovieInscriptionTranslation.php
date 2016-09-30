<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
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
    use \Base\CoreBundle\Util\TranslationChanges;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $commonContent;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $inscriptionContent;


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
     * Set inscriptionContent
     *
     * @param string $inscriptionContent
     * @return CorpoMovieInscriptionTranslation
     */
    public function setInscriptionContent($inscriptionContent)
    {
        $this->inscriptionContent = $inscriptionContent;

        return $this;
    }

    /**
     * Get inscriptionContent
     *
     * @return string 
     */
    public function getInscriptionContent()
    {
        return $this->inscriptionContent;
    }
}

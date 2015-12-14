<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Time;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilmAtelierProductionCompanyAddressTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierProductionCompanyAddressTranslation implements TranslateChildInterface
{
    use Translation;
    use Time;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * Set state
     *
     * @param string $state
     * @return FilmAtelierProductionCompanyAddressTranslation
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }
}

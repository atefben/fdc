<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;

use Base\CoreBundle\Util\Time;

/**
 * PressCinemaMapTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaMapTranslation
{
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="cinema_map_zone", type="string", length=255, nullable=true)
     */
    protected $mapZone;


    /**
     * Set mapZone
     *
     * @param string $mapZone
     * @return PressCinemaMapTranslation
     */
    public function setMapZone($mapZone)
    {
        $this->mapZone = $mapZone;

        return $this;
    }

    /**
     * Get mapZone
     *
     * @return string 
     */
    public function getMapZone()
    {
        return $this->mapZone;
    }
}

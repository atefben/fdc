<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;


/**
 * CcmModuleGoogleMapsTranslation
 * @ORM\Table(name="ccm_module_google_maps_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmModuleGoogleMapsTranslation
{

    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url_google_maps", type="string", length=255, nullable=true)
     */
    protected $urlGoogleMaps;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getUrlGoogleMaps()
    {
        return $this->urlGoogleMaps;
    }

    /**
     * @param string $urlGoogleMaps
     */
    public function setUrlGoogleMaps($urlGoogleMaps)
    {
        $this->urlGoogleMaps = $urlGoogleMaps;
    }
}


<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomepagePushTranslation
 * @ORM\Table(name="ccm_menu_translation")
 * @ORM\Entity
 */
class CcmMenuTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $urlProgram;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $urlCatalog;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $urlRegister;

    /**
     * Get UrlProgram.
     *
     * @return string
     */
    public function getUrlProgram()
    {
        return $this->urlProgram;
    }

    /**
     * Set urlProgram.
     *
     * @param string $urlProgram
     */
    public function setUrlProgram($urlProgram)
    {
        $this->urlProgram = $urlProgram;
    }

    /**
     * Get urlCatalog.
     *
     * @return string
     */
    public function getUrlCatalog()
    {
        return $this->urlCatalog;
    }

    /**
     * Set urlCatalog.
     *
     * @param string $urlCatalog
     */
    public function setUrlCatalog($urlCatalog)
    {
        $this->urlCatalog = $urlCatalog;
    }

    /**
     * Get urlRegister.
     *
     * @return string
     */
    public function getUrlRegister()
    {
        return $this->urlRegister;
    }

    /**
     * Set urlRegister.
     *
     * @param string $urlRegister
     */
    public function setUrlRegister($urlRegister)
    {
        $this->urlRegister = $urlRegister;
    }
}

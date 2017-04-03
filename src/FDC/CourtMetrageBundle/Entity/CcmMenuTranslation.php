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
     * @var boolean
     *
     * @ORM\Column(name="program_pic_is_active", type="boolean", nullable=true)
     */
    private $programPicIsActive = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="catalog_pic_is_active", type="boolean", nullable=true)
     */
    private $catalogPicIsActive = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="register_pic_is_active", type="boolean", nullable=true)
     */
    private $registerPicIsActive = true;

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

    /**
     * @return boolean
     */
    public function isProgramPicIsActive()
    {
        return $this->programPicIsActive;
    }

    /**
     * @param boolean $programPicIsActive
     */
    public function setProgramPicIsActive($programPicIsActive)
    {
        $this->programPicIsActive = $programPicIsActive;
    }

    /**
     * @return boolean
     */
    public function isCatalogPicIsActive()
    {
        return $this->catalogPicIsActive;
    }

    /**
     * @param boolean $catalogPicIsActive
     */
    public function setCatalogPicIsActive($catalogPicIsActive)
    {
        $this->catalogPicIsActive = $catalogPicIsActive;
    }

    /**
     * @return boolean
     */
    public function isRegisterPicIsActive()
    {
        return $this->registerPicIsActive;
    }

    /**
     * @param boolean $registerPicIsActive
     */
    public function setRegisterPicIsActive($registerPicIsActive)
    {
        $this->registerPicIsActive = $registerPicIsActive;
    }
}

<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use FDC\CourtMetrageBundle\Interfaces\CcmPictoInterface;
use FDC\CourtMetrageBundle\Util\CcmPicto;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmModuleTransportTranslation
 * @ORM\Table(name="ccm_module_transport_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmModuleTransportTranslation implements CcmPictoInterface
{

    use Translation;
    use TranslationChanges;
    use CcmPicto;

    /**
     * @var string
     *
     * @ORM\Column(name="picto", type="string", length=255, nullable=true)
     */
    protected $picto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @return string
     */
    public function getPicto()
    {
        return $this->picto;
    }

    /**
     * @param string $picto
     */
    public function setPicto($picto)
    {
        $this->picto = $picto;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}


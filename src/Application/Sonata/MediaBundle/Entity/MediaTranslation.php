<?php

namespace Application\Sonata\MediaBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * Schema is in Resources/config/doctrine/MediaTranslation.orm.xml
 */
class MediaTranslation implements OneLocaleInterface
{
    use Translation;
    use Time;
    
    /**
     * @var string
     */
    private $copyright;

    private $translatable_id;
    
    /**
     * Set copyright
     *
     * @param string $copyright
     * @return Article
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }
}

<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;

/**
 * MediaAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaImage extends Media
{
    use Translatable;
    use Translation;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
    
    public function __toString()
    {
        $translationFr = $this->findTranslationByLocale('fr');
     //   var_dump($translationFr);

     /*   if ($translationFr !== null && $translationFr->getAlt() != null) {
            return $translationFr->getAlt();
        }*/
        return '1';
        //return strval($this->getId());
    }
}

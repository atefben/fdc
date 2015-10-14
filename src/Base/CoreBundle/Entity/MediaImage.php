<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslationByLocale;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
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
    use TranslationByLocale;

    /**
     * @var ArrayCollection
     * @Groups({"news_list", "news_show"})
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

}

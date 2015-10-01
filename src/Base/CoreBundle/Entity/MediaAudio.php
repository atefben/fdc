<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Base\CoreBundle\Util\Time;

/**
 * MediaAudio
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MediaAudio extends Media
{
    use Translatable;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}

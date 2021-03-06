<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * EventWidgetText
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EventWidgetText extends EventWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     * @Groups({"event_show"})
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}

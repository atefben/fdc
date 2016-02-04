<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;

use Base\CoreBundle\Util\Time;

/**
 * PressCinemaRoomTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaRoomTranslation
{
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="cinema_room_title", type="string", length=255, nullable=true)
     */
    protected $title;


    /**
     * Set title
     *
     * @param string $title
     * @return PressCinemaRoomTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}

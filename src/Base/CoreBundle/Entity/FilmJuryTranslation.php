<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmJuryTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"jury_list", "jury_show"})
     */
    protected $biography;


    /**
     * Set biography
     *
     * @param string $biography
     * @return FilmJuryTranslation
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string 
     */
    public function getBiography()
    {
        return $this->biography;
    }
}

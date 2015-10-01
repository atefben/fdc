<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmJuryTypeTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"jury_list", "jury_show"})
     */
    protected $name;

    /**
     * Set name
     *
     * @param string $name
     * @return FilmJuryTypeTranslation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}

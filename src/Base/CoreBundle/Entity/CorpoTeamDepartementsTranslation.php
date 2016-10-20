<?php

namespace Base\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Sluggable\Util\Urlizer;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * CorpoTeamTranslation
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class CorpoTeamDepartementsTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"classics"})
     *
     */
    private $departementName;


    /**
     * Set departementName
     *
     * @param string $departementName
     * @return CorpoTeamDepartementsTranslation
     */
    public function setDepartementName($departementName)
    {
        $this->departementName = $departementName;

        return $this;
    }

    /**
     * Get departementName
     *
     * @return string 
     */
    public function getDepartementName()
    {
        return $this->departementName;
    }
}

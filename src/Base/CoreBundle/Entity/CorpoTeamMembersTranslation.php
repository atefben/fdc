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
class CorpoTeamMembersTranslation implements TranslateChildInterface
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
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"classics"})
     *
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"classics"})
     *
     */
    protected $function;

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return CorpoTeamMembersTranslation
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return CorpoTeamMembersTranslation
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set function
     *
     * @param string $function
     * @return CorpoTeamMembersTranslation
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return string 
     */
    public function getFunction()
    {
        return $this->function;
    }
}

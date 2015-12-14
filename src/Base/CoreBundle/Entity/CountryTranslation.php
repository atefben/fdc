<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * CountryTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class CountryTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "trailer_list", "trailer_show",
     *  "award_list", "award_show",
     *  "projection_list", "projection_show"
     * })
     */
    private $lang;

    public function __construct()
    {
        $this->status = self::STATUS_PUBLISHED;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CountryTranslation
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

    /**
     * Set lang
     *
     * @param string $lang
     * @return CountryTranslation
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }
}

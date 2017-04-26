<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Component\Gender;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Accessor;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmPersonTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use \Base\CoreBundle\Util\TranslationChanges;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     * @Accessor(getter="getApiProfession")
     */
    protected $profession;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     */
    protected $biography;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({
     *     "person_list",
     *     "person_show",
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list", "projection_list_2017", "programmation",
     *     "projection_show", "programmation_main"
     * })
     */
    protected $gender;

    public function __construct()
    {
        $this->status = self::STATUS_PUBLISHED;
    }

    /**
     * Set profession
     *
     * @param string $profession
     * @return FilmPersonTranslation
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string 
     */
    public function getProfession()
    {
        if ($this->translatable instanceof FilmPerson && $this->translatable->getDuplicate()) {
            return $this->profession;
        }
        $profession = $this->profession;
        if (!$profession) {
            foreach ($this->getTranslatable()->getDuplicates() as $duplicate) {
                foreach ($duplicate->getTranslations() as $translation) {
                    if ($profession) {
                        continue;
                    }
                    if ($this->locale == $translation->getLocale() && $translation->getProfession()) {
                        $profession = $translation->getProfession();
                    }
                }
            }
        }
        return $profession;
    }

    /**
     * Get profession formatted for api
     *
     * @return string
     */
    public function getApiProfession()
    {
        return Gender::functionGenderFormatter($this->getProfession(), $this->getGender());
    }


    /**
     * Set biography
     *
     * @param string $biography
     * @return FilmPersonTranslation
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
        if ($this->translatable->getDuplicate()) {
            return $this->biography;
        }
        $biography = $this->biography;
        if (!$biography) {
            foreach ($this->getTranslatable()->getDuplicates() as $duplicate) {
                foreach ($duplicate->getTranslations() as $translation) {
                    if ($biography) {
                        continue;
                    }
                    if ($this->locale == $translation->getLocale() && $translation->getBiography()) {
                        $biography = $translation->getBiography();
                    }
                }
            }
        }
        return $biography;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return FilmPersonTranslation
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }
}

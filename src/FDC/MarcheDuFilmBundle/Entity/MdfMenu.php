<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfMenu
 * @ORM\Table(name="mdf_menu")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfMenu implements TranslateMainInterface
{
    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $programProjectsIsActive = true;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $programEventsIsActive = true;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        $string = "Menu configuration";

        return $string;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return boolean
     */
    public function isProgramProjectsIsActive()
    {
        return $this->programProjectsIsActive;
    }

    /**
     * @param boolean $programProjectsIsActive
     */
    public function setProgramProjectsIsActive($programProjectsIsActive)
    {
        $this->programProjectsIsActive = $programProjectsIsActive;
    }

    /**
     * @return boolean
     */
    public function isProgramEventsIsActive()
    {
        return $this->programEventsIsActive;
    }

    /**
     * @param boolean $programEventsIsActive
     */
    public function setProgramEventsIsActive($programEventsIsActive)
    {
        $this->programEventsIsActive = $programEventsIsActive;
    }
}

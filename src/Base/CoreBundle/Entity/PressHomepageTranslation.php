<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressHomepageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressHomepageTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var PressHomepagePushMain
     *
     * @ORM\OneToMany(targetEntity="PressHomepagePushMain", mappedBy="homepageTranslation")
     */
    public $pushsMain;

    /**
     * @var PressHomepagePushSecondary
     *
     * @ORM\OneToMany(targetEntity="PressHomepagePushSecondary", mappedBy="homepageTranslation")
     */
    public $pushsSecondary;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pushsMain = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pushsSecondary = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set title
     *
     * @param string $title
     * @return PressHomepageTranslation
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

    /**
     * Add pushsMain
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain
     * @return PressHomepageTranslation
     */
    public function addPushsMain(\Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain)
    {
        $this->pushsMain[] = $pushsMain;

        return $this;
    }

    /**
     * Remove pushsMain
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain
     */
    public function removePushsMain(\Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain)
    {
        $this->pushsMain->removeElement($pushsMain);
    }

    /**
     * Get pushsMain
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPushsMain()
    {
        return $this->pushsMain;
    }

    /**
     * Add pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary
     * @return PressHomepageTranslation
     */
    public function addPushsSecondary(\Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary[] = $pushsSecondary;

        return $this;
    }

    /**
     * Remove pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary
     */
    public function removePushsSecondary(\Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary->removeElement($pushsSecondary);
    }

    /**
     * Get pushsSecondary
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPushsSecondary()
    {
        return $this->pushsSecondary;
    }
}

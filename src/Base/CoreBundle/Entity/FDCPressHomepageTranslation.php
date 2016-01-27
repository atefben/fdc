<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FDCPressHomepageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPressHomepageTranslation
{
    use Time;
    use Translation;

    /**
     * @var $title
     */
    private $title;

    /**
     * @var FDCPressHomepagePushMain
     *
     * @ORM\OneToMany(targetEntity="FDCPressHomepagePushMain", mappedBy="homepageTranslation")
     */
    private $pushsMain;

    /**
     * @var FDCPressHomepagePushSecondary
     *
     * @ORM\OneToMany(targetEntity="FDCPressHomepagePushSecondary", mappedBy="homepageTranslation")
     */
    private $pushsSecondary;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pushsMain = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pushsSecondary = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add pushsMain
     *
     * @param \Base\CoreBundle\Entity\FDCPressHomepagePushMain $pushsMain
     * @return FDCPressHomepageTranslation
     */
    public function addPushsMain(\Base\CoreBundle\Entity\FDCPressHomepagePushMain $pushsMain)
    {
        $this->pushsMain[] = $pushsMain;

        return $this;
    }

    /**
     * Remove pushsMain
     *
     * @param \Base\CoreBundle\Entity\FDCPressHomepagePushMain $pushsMain
     */
    public function removePushsMain(\Base\CoreBundle\Entity\FDCPressHomepagePushMain $pushsMain)
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
     * @param \Base\CoreBundle\Entity\FDCPressHomepagePushSecondary $pushsSecondary
     * @return FDCPressHomepageTranslation
     */
    public function addPushsSecondary(\Base\CoreBundle\Entity\FDCPressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary[] = $pushsSecondary;

        return $this;
    }

    /**
     * Remove pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\FDCPressHomepagePushSecondary $pushsSecondary
     */
    public function removePushsSecondary(\Base\CoreBundle\Entity\FDCPressHomepagePushSecondary $pushsSecondary)
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

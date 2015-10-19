<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * HomepageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageTranslation
{
    use Time;
    use Translation;

    /**
     * @var HomepagePush
     *
     * @ORM\OneToMany(targetEntity="HomepagePushMain", mappedBy="homepageTranslation")
     */
    private $pushsMain;

    /**
     * @var HomepagePush
     *
     * @ORM\OneToMany(targetEntity="HomepagePushSecondary", mappedBy="homepageTranslation")
     */
    private $pushsSecondary;

    /**
     * @var Prefooter
     *
     * @ORM\OneToMany(targetEntity="Prefooter", mappedBy="homepageTranslation")
     */
    private $prefooters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pushsMain = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pushsSecondary = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prefooters = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add pushsMain
     *
     * @param \Base\CoreBundle\Entity\HomepagePushMain $pushsMain
     * @return HomepageTranslation
     */
    public function addPushsMain(\Base\CoreBundle\Entity\HomepagePushMain $pushsMain)
    {
        $this->pushsMain[] = $pushsMain;

        return $this;
    }

    /**
     * Remove pushsMain
     *
     * @param \Base\CoreBundle\Entity\HomepagePushMain $pushsMain
     */
    public function removePushsMain(\Base\CoreBundle\Entity\HomepagePushMain $pushsMain)
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
     * @param \Base\CoreBundle\Entity\HomepagePushSecondary $pushsSecondary
     * @return HomepageTranslation
     */
    public function addPushsSecondary(\Base\CoreBundle\Entity\HomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary[] = $pushsSecondary;

        return $this;
    }

    /**
     * Remove pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\HomepagePushSecondary $pushsSecondary
     */
    public function removePushsSecondary(\Base\CoreBundle\Entity\HomepagePushSecondary $pushsSecondary)
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

    /**
     * Add prefooters
     *
     * @param \Base\CoreBundle\Entity\Prefooter $prefooters
     * @return HomepageTranslation
     */
    public function addPrefooter(\Base\CoreBundle\Entity\Prefooter $prefooters)
    {
        $this->prefooters[] = $prefooters;

        return $this;
    }

    /**
     * Remove prefooters
     *
     * @param \Base\CoreBundle\Entity\Prefooter $prefooters
     */
    public function removePrefooter(\Base\CoreBundle\Entity\Prefooter $prefooters)
    {
        $this->prefooters->removeElement($prefooters);
    }

    /**
     * Get prefooters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrefooters()
    {
        return $this->prefooters;
    }
}

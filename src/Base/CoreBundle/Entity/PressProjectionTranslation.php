<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * PressProjectionTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressProjectionTranslation implements TranslateChildInterface
{
    use TranslateChild;
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $schedulingLabel;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $pressSchedulingLabel;


    /**
     * Set schedulingLabel
     *
     * @param string $schedulingLabel
     * @return PressProjectionTranslation
     */
    public function setSchedulingLabel($schedulingLabel)
    {
        $this->schedulingLabel = $schedulingLabel;

        return $this;
    }

    /**
     * Get schedulingLabel
     *
     * @return string 
     */
    public function getSchedulingLabel()
    {
        return $this->schedulingLabel;
    }

    /**
     * Set pressSchedulingLabel
     *
     * @param string $pressSchedulingLabel
     * @return PressProjectionTranslation
     */
    public function setPressSchedulingLabel($pressSchedulingLabel)
    {
        $this->pressSchedulingLabel = $pressSchedulingLabel;

        return $this;
    }

    /**
     * Get pressSchedulingLabel
     *
     * @return string 
     */
    public function getPressSchedulingLabel()
    {
        return $this->pressSchedulingLabel;
    }
}

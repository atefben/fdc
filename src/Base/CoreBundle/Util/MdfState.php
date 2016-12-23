<?php

namespace Base\CoreBundle\Util;

trait MdfState
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $state = self::STATE_INACTIVE;

    /**
     * @return array
     */
    public static function getPromotionStatuses()
    {
        return array(
            '' => '',
            self::STATE_INACTIVE => 'form.status.inactive',
            self::STATE_ACTIVE => 'form.status.active',
            self::STATE_EARLY_BIRD => 'form.status.early_bird'
        );
    }

    /**
     * getMainStatuses function.
     *
     * @access public
     * @static
     */
    public static function getMainStatuses()
    {
        return array(
            '' => '',
            self::STATE_INACTIVE => 'form.status.inactive',
            self::STATE_ACTIVE => 'form.status.active',
            self::STATE_DEACTIVATED => 'form.status.deactivated'
        );
    }

    /**
     * @param $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }
}

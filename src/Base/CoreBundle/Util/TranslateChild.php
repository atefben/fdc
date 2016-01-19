<?php

namespace Base\CoreBundle\Util;

/**
 * TranslateChild trait.
 *
 * @author  Antoine Mineau
 * @company Ohwee
 */
trait TranslateChild
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $lockedBy;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lockedAt;

    /**
     * getStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getStatuses()
    {
        return array(
            self::STATUS_DRAFT => 'form.status.draft',
            self::STATUS_TRANSLATION_PENDING => 'form.status.translation_pending',
            self::STATUS_TRANSLATION_VALIDATING => 'form.status.translation_validating',
            self::STATUS_VALIDATING => 'form.status.validating',
            self::STATUS_TRANSLATED => 'form.status.translated',
            self::STATUS_PUBLISHED => 'form.status.published',
            self::STATUS_DEACTIVATED => 'form.status.deactivated'
        );
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set lockedAt
     *
     * @param \DateTime $lockedAt
     */
    public function setLockedAt($lockedAt)
    {
        $this->lockedAt = $lockedAt;

        return $this;
    }

    /**
     * Get lockedAt
     *
     * @return \DateTime
     */
    public function getLockedAt()
    {
        return $this->lockedAt;
    }

    /**
     * Set lockedBy
     *
     * @param \Application\Sonata\UserBundle\Entity\User $lockedBy
     */
    public function setLockedBy(\Application\Sonata\UserBundle\Entity\User $lockedBy = null)
    {
        $this->lockedBy = $lockedBy;

        return $this;
    }

    /**
     * Get lockedBy
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getLockedBy()
    {
        return $this->lockedBy;
    }
}
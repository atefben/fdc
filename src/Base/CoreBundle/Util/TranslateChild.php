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
     * @ORM\Column(type="integer", nullable=false)
     */
    private $status;

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
     * @return NewsThemeTranslation
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
}
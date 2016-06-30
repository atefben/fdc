<?php

namespace Base\CoreBundle\Util;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * TranslateMain trait.
 *
 * @author  Antoine Mineau
 * @company Ohwee
 */
trait TranslateMain
{
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $translate = false;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $translateOptions;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $priorityStatus = self::PRIORITY_STATUS_LOW;


    public function getLocaleSlugs()
    {
        $translations = $this->getTranslations();
        $slugs = array();

        foreach ($translations as $trans) {
            $slugs[$trans->getLocale()] = ($trans->getSlug() != null) ? $trans->getSlug() : '404';
        }

        return $slugs;
    }

    /**
     * getAvailableTranslateOptions function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getAvailableTranslateOptions()
    {
        return array(
            self::TRANSLATE_OPTION_EN => 'form.translate_option.en',
            self::TRANSLATE_OPTION_ZH => 'form.translate_option.zh',
            self::TRANSLATE_OPTION_ES => 'form.translate_option.es'
        );
    }

    /**
     * getPriorityStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getPriorityStatuses()
    {
        return array(
            self::PRIORITY_STATUS_LOW => 'form.priority_status.low',
            self::PRIORITY_STATUS_AVERAGE => 'form.priority_status.average',
            self::PRIORITY_STATUS_URGENT => 'form.priority_status.urgent',
            self::PRIORITY_STATUS_NOW => 'form.priority_status.now'
        );
    }

    /**
     * getPriorityStatusesList function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getPriorityStatusesList()
    {
        return array(
            self::PRIORITY_STATUS_NONE => '',
            self::PRIORITY_STATUS_LOW => 'form.priority_status.low',
            self::PRIORITY_STATUS_AVERAGE => 'form.priority_status.average',
            self::PRIORITY_STATUS_URGENT => 'form.priority_status.urgent',
            self::PRIORITY_STATUS_NOW => 'form.priority_status.now'
        );
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * @param $translation
     * @param $locale
     * @return $this
     */
    public function setTranslation($translation, $locale)
    {
        foreach ($this->getTranslations() as &$t) {
            if ($t->getLocale() == $locale) {
                $t = $translation;
            }
        }

        return $this;
    }

    public function getStatusMain()
    {
        $status = TranslateChildInterface::STATUS_DRAFT;

        $trans = $this->findTranslationByLocale('fr');
        if ($trans) {
            return $trans->getStatus();
        }
    }

    /**
     * Set translateOptions
     *
     * @param array $translateOptions
     */
    public function setTranslateOptions($translateOptions)
    {
        $this->translateOptions = $translateOptions;

        return $this;
    }

    /**
     * Get translateOptions
     */
    public function getTranslateOptions()
    {
        return $this->translateOptions;
    }

    /**
     * Set translate
     *
     * @param boolean $translate
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;

        return $this;
    }

    /**
     * Get translate
     *
     * @return boolean
     */
    public function getTranslate()
    {
        return $this->translate;
    }

    /**
     * Set priorityStatus
     *
     * @param integer $priorityStatus
     */
    public function setPriorityStatus($priorityStatus)
    {
        $this->priorityStatus = $priorityStatus;

        return $this;
    }

    /**
     * Get priorityStatus
     *
     * @return integer
     */
    public function getPriorityStatus()
    {
        return $this->priorityStatus;
    }

}
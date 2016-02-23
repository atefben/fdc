<?php

namespace Base\AdminBundle\Component\Admin;

use DateTime;

abstract class Export
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_TRANSLATION_PENDING = 2;
    const STATUS_TRANSLATION_VALIDATING = 3;
    const STATUS_VALIDATING = 4;
    const STATUS_TRANSLATED = 5;
    const STATUS_DEACTIVATED = 6;

    /**
     * @param $dateTime
     * @return string
     */
    public static function formatDate($dateTime)
    {
        if ($dateTime instanceof DateTime) {
            return $dateTime->format('Y-m-d H:i:s');
        }
        return '';
    }

    /**
     * @param DateTime $from
     * @param DateTime $to
     * @return string
     */
    public static function publishsDates($from, $to)
    {
        $begin = '';
        $dateBegin = static::formatDate($from);
        if ($dateBegin) {
            $begin = 'Du ' . $dateBegin;

        }

        $end = '';
        if ($to instanceof DateTime) {
            $end = ' au ' . static::formatDate($to);
        }
        return $begin . $end;
    }

    /**
     * @param $sites
     * @return string
     */
    public static function sites($sites)
    {
        $output = '';
        foreach ($sites as $site) {
            $output .= ($output ? ', ' : '') . $site->getName();
        }
        return $output;
    }

    /**
     * @param $status
     * @return string
     */
    public static function formatTranslationStatus($status)
    {
        if ($status === '' || $status === null) {
            return '';
        }
        $statuses = array(
            self::STATUS_DRAFT                  => 'Brouillon',
            self::STATUS_TRANSLATION_PENDING    => 'À traduire',
            self::STATUS_TRANSLATION_VALIDATING => 'Traduction(s) à valider',
            self::STATUS_VALIDATING             => 'À valider',
            self::STATUS_TRANSLATED             => 'Traduit',
            self::STATUS_PUBLISHED              => 'Publié',
            self::STATUS_DEACTIVATED            => 'Désactivé'
        );
        return $statuses[$status];
    }

    /**
     * @param $object
     * @param $field
     * @param string $locale
     * @return mixed
     */
    public static function translationField($object, $field, $locale = 'fr')
    {
        if (!$object) {
            return '';
        }
        $method = 'get' . ucfirst($field);
        $translation = $object->findTranslationByLocale($locale);

        if ($translation && method_exists($translation, $method)) {
            return $translation->$method();
        }
        return '';
    }

    /**
     * @param $value
     * @return string
     */
    public static function yesOrNo($value)
    {
        return (bool)$value ? 'Oui' : 'Non';
    }
}
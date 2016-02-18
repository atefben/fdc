<?php

namespace Base\AdminBundle\Component\Admin;

use Sonata\AdminBundle\Admin\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    public function filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value)
    {
        static $joined = false;
        if (!$joined) {
            $queryBuilder
                ->join("{$alias}.translations", 't')
                ->where('t.locale = :locale')
                ->setParameter('locale', 'fr')
            ;
        }
        $joined = true;

        return $queryBuilder;
    }
}
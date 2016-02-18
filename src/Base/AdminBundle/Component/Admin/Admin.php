<?php

namespace Base\AdminBundle\Component\Admin;

use Base\CoreBundle\Entity\MediaImageSimple;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Sonata\AdminBundle\Admin\Admin as BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

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

    public function addCreatedBetweenFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('createdBefore', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere('o.createdAt < :before');
                    $queryBuilder->setParameter('before', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type'    => 'date',
                'field_options' => array(
                    'widget' => 'single_text',
                ),
                'label'         => 'filter.common.label_created_before',
            ))
            ->add('createdAfter', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere('o.createdAt > :after');
                    $queryBuilder->setParameter('after', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type'    => 'date',
                'field_options' => array(
                    'widget' => 'single_text',
                ),
                'label'         => 'filter.common.label_created_after',
            ))
        ;

        return $mapper;
    }

    public function addStatusFilter(DatagridMapper $mapper)
    {
        return $mapper->add('status', 'doctrine_orm_callback', array(
            'callback'      => function ($queryBuilder, $alias, $field, $value) {
                if ($value['value'] !== null) {
                    return;
                }
                $queryBuilder = $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                $queryBuilder->andWhere('t.status = :status');
                $queryBuilder->setParameter('status', $value['value']);

                return true;
            },
            'field_type'    => 'choice',
            'field_options' => array(
                'choices'                   => NewsArticleTranslation::getStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ),
        ));
    }

    public function addPriorityFilter(DatagridMapper $mapper)
    {
        return $mapper->add('priorityStatus', 'doctrine_orm_callback', array(
            'callback'      => function ($queryBuilder, $alias, $field, $value) {
                if ($value['value'] !== null) {
                    return;
                }
                $queryBuilder->andWhere('o.priorityStatus LIKE :priorityStatus');
                $queryBuilder->setParameter('priorityStatus', '%' . $value['value'] . '%');

                return true;
            },
            'field_type'    => 'choice',
            'field_options' => array(
                'choices'                   => MediaImageSimple::getPriorityStatusesList(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ),
        ));
    }

}
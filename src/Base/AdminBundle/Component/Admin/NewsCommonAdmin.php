<?php

namespace Base\AdminBundle\Component\Admin;

use Base\AdminBundle\Component\Admin\Admin as BaseAdmin;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Tests\DependencyInjection\News;

class NewsCommonAdmin extends BaseAdmin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    public function filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $field, $value)
    {
        static $joined = false;
        if (!$joined) {
            $queryBuilder
                ->join("{$alias}.translations", 't2');
            $joined = true;
        }

        return $queryBuilder;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label'      => 'list.news_common.label_title',
            ))
            ->add('theme')
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addPublishedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);

        $datagridMapper
            ->add('status_translation_pending', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    if (!$value['value']) {
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $field, $value);
                        $queryBuilder->andWhere('t2.status = :translation_pending');
                        $queryBuilder->setParameter('translation_pending', NewsArticleTranslation::STATUS_TRANSLATION_PENDING);
                    }
                    return true;
                },
                'field_type' => 'checkbox',
                'label'      => 'list.news_common.translation_pending',
            ))
            ->add('status_translation_validating', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }

                    if ($value['value']) {
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $field, $value);
                        $queryBuilder->andWhere('t2.status = :translation_validating');
                        $queryBuilder->setParameter('translation_validating', NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING);
                    }
                    return true;
                },
                'field_type' => 'checkbox',
                'label'      => 'list.news_common.translation_validating',
            ))
            ->add('status_translated', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }

                    if ($value['value']) {
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $field, $value);
                        $queryBuilder->andWhere('t2.status = :translated');
                        $queryBuilder->setParameter('translated', NewsArticleTranslation::STATUS_TRANSLATED);
                    }
                    return true;
                },
                'field_type' => 'checkbox',
                'label'      => 'list.news_common.translated',
            ))
        ;
        $datagridMapper = $this->addPriorityFilter($datagridMapper);
    }


    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
                'label'    => 'list.news_common.label_title',
            ))
            ->add('theme', null, array())
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('displayedMobile', null, array(
                'label' => 'list.displayed_mobile',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => NewsArticle::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => NewsArticleTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
            ))
            ->add('_preview', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_preview.html.twig'
            ))
        ;
    }


    public function getExportFields()
    {
        return array(
            'Id'                                        => 'id',
            'Titre de l\'actualité'                    => 'exportTitle',
            'Thème'                                     => 'exportTheme',
            'Identifiant créateur'                      => 'exportAuthor',
            'Date de création'                          => 'exportCreatedAt',
            'Dates de publication'                      => 'exportPublishDates',
            'Date de modification'                      => 'exportUpdatedAt',
            'Statut master'                             => 'exportStatusMaster',
            'Statut traduction es'                      => 'exportStatusEn',
            'Statut traduction en'                      => 'exportStatusEs',
            'Statut traduction zh'                      => 'exportStatusZh',
            'Publié sur'                                => 'exportSites',
        );
    }

}
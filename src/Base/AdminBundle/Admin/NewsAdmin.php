<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * NewsAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class NewsAdmin extends Admin
{
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.hidden', ':hidden')
        );
        $query->setParameter('hidden', false);
        return $query;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
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
                    if ($value['value'] === null) {
                        return;
                    }
                    if ($value['value']) {
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
                    if ($value['value'] === null) {
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
                    if ($value['value'] === null) {
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
            ->add('type', null, array(
                'template' => 'BaseAdminBundle:News:list_type.html.twig',
                'label'    => 'show.label_type',
            ))
            ->add('theme', null, array())
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
                'label'    => 'show.label_created_at'
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
                'label'    => 'form.label_published_at'
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => NewsArticle::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle',
                'label'     => 'form.label_priority_status'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => NewsArticleTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle',
                'label'     => 'show.label_status'
            ))
            ->add('translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_see_translations.html.twig',
                'label'    => 'dashboard.link.bo_translation',
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
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

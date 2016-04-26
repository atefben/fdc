<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoArticleTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * InfoAdmin class.
 * 
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoAdmin extends Admin
{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('acl');
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.hidden', ':hidden')
        );
        $query->setParameter('hidden', false);
        return $query;
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    public function filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $status)
    {
        static $joined = false;
        if (!$joined) {
            $queryBuilder
                ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 'na1', 'WITH', "na1.id = {$alias}.id")
                ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 'na2', 'WITH', "na2.id = {$alias}.id")
                ->leftjoin('Base\CoreBundle\Entity\StatementImage', 'na3', 'WITH', "na3.id = {$alias}.id")
                ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 'na4', 'WITH', "na4.id = {$alias}.id")
                ->leftjoin('na1.translations', 'na1t')
                ->leftjoin('na2.translations', 'na2t')
                ->leftjoin('na3.translations', 'na3t')
                ->leftjoin('na4.translations', 'na4t')
                ->andWhere( '(na1t.status = :status) OR
                             (na2t.status = :status) OR
                             (na3t.status = :status) OR
                             (na4t.status = :status)'
                )
                ->setParameter('status', $status)
            ;
            $joined = true;
        }
        return $queryBuilder;
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
                'label'      => 'list.info_common.label_title',
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
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, InfoArticleTranslation::STATUS_TRANSLATION_PENDING);
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
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, InfoArticleTranslation::STATUS_TRANSLATION_VALIDATING);
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
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, InfoArticleTranslation::STATUS_TRANSLATED);
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
            ->add('id', null, array('label' => 'list.info_common.label_id'))
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
                'label'    => 'list.info_common.label_title',
            ))
            ->add('type', null, array(
                'template' => 'BaseAdminBundle:News:list_type.html.twig',
                'label'    => 'show.label_type',
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
                'choices'   => InfoArticle::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => InfoArticleTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_see_translations.html.twig',
                'label'    => 'dashboard.link.bo_translation'
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

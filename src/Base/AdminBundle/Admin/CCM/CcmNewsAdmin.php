<?php

namespace Base\AdminBundle\Admin\CCM;


use Base\AdminBundle\Component\Admin\Admin;
use Base\CoreBundle\Entity\FilmFilm;
use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmNews;
use FDC\CourtMetrageBundle\Entity\CcmNewsArticleTranslation;
use FDC\CourtMetrageBundle\Entity\CcmNewsFilmFilmAssociated;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * CcmNewsAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class CcmNewsAdmin extends Admin
{
    protected $baseRouteName = 'ccm_news';
    protected $baseRoutePattern = 'ccmnews';

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->em = $entityManager;
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

    public function filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $status)
    {
        static $joined = false;
        if (!$joined) {
            $queryBuilder
                ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', "na1.id = {$alias}.id")
                ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', "na2.id = {$alias}.id")
                ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', "na3.id = {$alias}.id")
                ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', "na4.id = {$alias}.id")
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
                    /* todo replace this and add it to statement and info */
                    $url = $_SERVER['REQUEST_URI'];
                    $url = explode("/", $url);
                    if ($url[4] != 'news') {
                        $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                        $queryBuilder->andWhere('t.title LIKE :title');
                        $queryBuilder->setParameter('title', '%' . $value['value'] . '%');
                        return true;
                    } else {
                        $queryBuilder
                            ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsArticle', 'na1', 'WITH', "na1.id = {$alias}.id")
                            ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsAudio', 'na2', 'WITH', "na2.id = {$alias}.id")
                            ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsImage', 'na3', 'WITH', "na3.id = {$alias}.id")
                            ->leftjoin('FDC\CourtMetrageBundle\Entity\CcmNewsVideo', 'na4', 'WITH', "na4.id = {$alias}.id")
                            ->leftjoin('na1.translations', 'na1t')
                            ->leftjoin('na2.translations', 'na2t')
                            ->leftjoin('na3.translations', 'na3t')
                            ->leftjoin('na4.translations', 'na4t')
                            ->andWhere('
                                na1t.title LIKE :title OR
                                na2t.title LIKE :title OR
                                na3t.title LIKE :title OR
                                na4t.title LIKE :title
                            ');
                        $queryBuilder->setParameter('title', '%' . $value['value'] . '%');
                        return true;
                    }
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
                    if ($value['value']) {
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, CcmNewsArticleTranslation::STATUS_TRANSLATION_PENDING);
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
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, CcmNewsArticleTranslation::STATUS_TRANSLATION_VALIDATING);
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
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, CcmNewsArticleTranslation::STATUS_TRANSLATED);
                    }
                    return true;
                },
                'field_type' => 'checkbox',
                'label'      => 'list.news_common.translated',
            ))
        ;
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
                'label'    => 'show.label_created_at'
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
                'label'    => 'form.label_published_at'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => CcmNewsArticleTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle',
                'label'     => 'show.label_status'
            ))
            ->add('_preview', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_preview.html.twig'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
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

    /**
     * @param mixed $news
     * @return mixed|void
     */
    public function prePersist($news)
    {
        $this->handleFilmAssociation($news);
    }

    /**
     * @param mixed $news
     * @return mixed|void
     */
    public function preUpdate($news)
    {
        $this->handleFilmAssociation($news);
    }

    /**
     * @param CcmNews $news
     */
    private function handleFilmAssociation($news)
    {
        /** @var EntityManager $em */
        $em = $this->em;
        /**
         * if the news article IS associated with a Film
         * we also create an entry in the CcmNewsFilmFilmAssociated table
         * in order for it to show up when editing a Film in the BO
         */
        if ($news->getAssociatedFilm() != null) {
            /** @var FilmFilm $associatedFilm */
            $associatedFilm = $news->getAssociatedFilm();
            /** @var CcmNewsFilmFilmAssociated $association */
            $association = $em->getRepository(CcmNewsFilmFilmAssociated::class)->findOneBy([
                'ccmNews'     => $news,
                'association' => $associatedFilm
            ]);
            if ($association == null) {
                $association = new CcmNewsFilmFilmAssociated();
                $association
                    ->setCcmNews($news)
                    ->setAssociation($associatedFilm)
                ;
                $em->persist($association);
                $em->flush();
            }
        } else {
            /**
             * if the news is not associated with a film,
             * we find and remove all existing film -> ccm news associations
             *
             * @var CcmNewsFilmFilmAssociated[] $existingAssociations
             */
            $existingAssociations = $em->getRepository(CcmNewsFilmFilmAssociated::class)->findBy([
                'ccmNews' => $news
            ]);
            foreach ($existingAssociations as $association) {
                $em->remove($association);
            }
            $em->flush();
        }
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('acl');
        $collection->add('previewnews', $this->getRouterIdParameter().'/previewnews');
    }
}

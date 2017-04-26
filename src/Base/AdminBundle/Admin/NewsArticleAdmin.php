<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\NewsCommonAdmin as Admin;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class NewsArticleAdmin
 * @package Base\AdminBundle\Admin
 */
class NewsArticleAdmin extends Admin
{
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $alias = $query->getRootAliases()[0];

        if (in_array('Orange', $this->getUser()->getGroupNames())) {
            $query->andWhere("$alias.orange = :orange");
            $query->setParameter(':orange', true);
        } else {
            $query->andWhere("$alias.orange = :orange OR $alias.orange is null");
            $query->setParameter(':orange', false);
            $query->andWhere("$alias.hidden = :hidden");
            $query->setParameter(':hidden', false);
        }
        return $query;
    }

    protected $formOptions = [
        'cascade_validation' => true,
    ];

    protected $translationDomain = 'BaseAdminBundle';


    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function getFormTheme()
    {
        return array_merge(parent::getFormTheme(), ['BaseAdminBundle:Form:polycollection.html.twig']);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if (in_array('Orange', $this->getUser()->getGroupNames())) {
            $this->configureOrangeFormFields($formMapper);
        } else {
            $formMapper
                ->add('translations', 'a2lix_translations', [
                    'label'              => false,
                    'translation_domain' => 'BaseAdminBundle',
                    'fields'             => [
                        'applyChanges'   => [
                            'field_type' => 'hidden',
                            'attr'       => [
                                'class' => 'hidden',
                            ],
                        ],
                        'title'          => [
                            'label'              => 'form.label_title',
                            'translation_domain' => 'BaseAdminBundle',
                            'sonata_help'        => 'form.news.helper_title',
                            'constraints'        => [
                                new NotBlank(),
                            ],
                        ],
                        'introduction'   => [
                            'field_type'         => 'ckeditor',
                            'label'              => 'form.label_introduction',
                            'translation_domain' => 'BaseAdminBundle',
                            'required'           => false,
                        ],
                        'createdAt'      => [
                            'display' => false,
                        ],
                        'updatedAt'      => [
                            'display' => false,
                        ],
                        'status'         => [
                            'label'                     => 'form.label_status',
                            'translation_domain'        => 'BaseAdminBundle',
                            'field_type'                => 'choice',
                            'choices'                   => NewsArticleTranslation::getStatuses(),
                            'choice_translation_domain' => 'BaseAdminBundle',
                        ],
                        'seoTitle'       => [
                            'attr'               => [
                                'placeholder' => 'form.placeholder_seo_title',
                            ],
                            'label'              => 'form.label_seo_title',
                            'sonata_help'        => 'form.news.helper_seo_title',
                            'translation_domain' => 'BaseAdminBundle',
                            'required'           => false,
                        ],
                        'seoDescription' => [
                            'attr'               => [
                                'placeholder' => 'form.placeholder_seo_description',
                            ],
                            'label'              => 'form.label_seo_description',
                            'sonata_help'        => 'form.news.helper_description',
                            'translation_domain' => 'BaseAdminBundle',
                            'required'           => false,
                        ],
                    ],
                ])
                ->add('sites', null, [
                    'label'    => 'form.label_publish_on',
                    'class'    => 'BaseCoreBundle:Site',
                    'multiple' => true,
                    'expanded' => true,
                ])
                ->add('publishedAt', 'sonata_type_datetime_picker', [
                    'format'   => 'dd/MM/yyyy HH:mm',
                    'required' => false,
                    'attr'     => [
                        'data-date-format' => 'dd/MM/yyyy HH:mm',
                    ],
                ])
                ->add('publishEndedAt', 'sonata_type_datetime_picker', [
                    'format'   => 'dd/MM/yyyy HH:mm',
                    'required' => false,
                    'attr'     => [
                        'data-date-format' => 'dd/MM/yyyy HH:mm',
                    ],
                ])
                ->add('widgets', 'infinite_form_polycollection', [
                    'label'        => false,
                    'types'        => [
                        'news_widget_text_type',
                        'news_widget_quote_type',
                        'news_widget_audio_type',
                        'news_widget_image_type',
                        'news_widget_image_dual_align_type',
                        'news_widget_video_type',
                        'news_widget_video_youtube_type',
                    ],
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'prototype'    => true,
                    'by_reference' => false,
                ])
                ->add('theme', 'sonata_type_model_list', [
                    'btn_delete' => false,
                    'required'   => false,
                ])
                ->add('tags', 'sonata_type_collection', [
                    'label'        => 'form.label_article_tags',
                    'help'         => 'form.news.helper_tags',
                    'by_reference' => false,
                    'required'     => false,
                ], [
                        'edit'   => 'inline',
                        'inline' => 'table',
                    ]
                )
                ->add('signature', null, [
                    'help' => 'form.news.helper_signature',
                ])
                ->add('header', 'sonata_type_model_list', [
                    'label'              => 'form.label_header_image',
                    'help'               => 'form.news.helper_header_image',
                    'translation_domain' => 'BaseAdminBundle',
                    'btn_delete'         => false,
                    'required'           => false,
                ])
                ->add('associatedFilm', 'sonata_type_model_list', [
                    'help'     => 'form.news.helper_film_film_associated',
                    'required' => false,
                    'btn_add'  => false,
                ])
                ->add('associatedEvent', 'sonata_type_model_list', [
                    'help'     => 'form.news.helper_event_associated',
                    'required' => false,
                    'btn_add'  => false,
                ])
                ->add('associatedProjections', 'sonata_type_collection', [
                    'label'        => 'form.label_news_film_projection_associated',
                    'help'         => 'form.news.helper_news_film_projection_associated',
                    'by_reference' => false,
                    'required'     => false,
                ], [
                        'edit'   => 'inline',
                        'inline' => 'table',
                    ]
                )
                ->add('associatedFilms', 'sonata_type_collection', [
                    'label'        => 'form.label_news_film_film_associated',
                    'help'         => 'form.news.helper_news_film_film_associated',
                    'by_reference' => false,
                    'required'     => false,
                ], [
                        'edit'   => 'inline',
                        'inline' => 'table',
                    ]
                )
                ->add('associatedNews', 'sonata_type_collection', [
                    'label'        => 'form.label_news_news_associated',
                    'help'         => 'form.news.helper_news_news_associated',
                    'by_reference' => false,
                    'btn_add'      => false,
                    'required'     => false,
                ], [
                        'edit'   => 'inline',
                        'inline' => 'table',
                    ]
                )
                ->add('mobileDisplay', 'choice', [
                    'required'                  => false,
                    'choices'                   => [
                        'big'  => 'form.label_mobile_display_big',
                        'main' => 'form.label_mobile_display_main',
                    ],
                    'choice_translation_domain' => 'BaseAdminBundle',
                ])
                ->add('hideSameDay')
                ->add('displayedHome')
                ->add('displayedMobile')
                ->add('translate')
                ->add('translateOptions', 'choice', [
                    'choices'            => News::getAvailableTranslateOptions(),
                    'translation_domain' => 'BaseAdminBundle',
                    'multiple'           => true,
                    'expanded'           => true,
                ])
                ->add('priorityStatus', 'choice', [
                    'choices'                   => News::getPriorityStatuses(),
                    'choice_translation_domain' => 'BaseAdminBundle',
                ])
                ->add('seoFile', 'sonata_media_type', [
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'seo_file',
                    'help'     => 'form.seo.helper_file',
                    'required' => false,
                ])
                // must be added to display informations about creation user / date, update user / date (top of right sidebar)
                ->add('createdAt', null, [
                    'label' => false,
                    'attr'  => [
                        'class' => 'hidden',
                    ],
                    'years' => range(1960, (int)date('Y') + 5),
                ])
                ->add('createdBy', null, [
                    'label' => false,
                    'attr'  => [
                        'class' => 'hidden',
                    ],
                ])
                ->add('updatedAt', null, [
                    'label' => false,
                    'attr'  => [
                        'class' => 'hidden',
                    ],
                ])
                ->add('updatedBy', null, [
                    'label' => false,
                    'attr'  => [
                        'class' => 'hidden',
                    ],
                ])
                ->end()
            ;
        }
    }

    private function configureOrangeFormFields(FormMapper $formMapper)
    {
        if (!$this->getSubject()->getId()) {
            $this->getSubject()->setOrange(true);
            $this->getSubject()->setDisplayedMobile(true);
            $this->getSubject()->setHidden(true);
            $this->getSubject()->setOrangeType('OCS');
        }

        $formMapper
            ->add('translations', 'a2lix_translations', [
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'fields'             => [
                    'applyChanges' => [
                        'field_type' => 'hidden',
                        'attr'       => [
                            'class' => 'hidden',
                        ],
                    ],
                    'title'        => [
                        'label'              => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.news.helper_title',
                        'constraints'        => [
                            new NotBlank(),
                        ],
                    ],
                    'introduction' => [
                        'field_type'         => 'ckeditor',
                        'label'              => 'form.label_introduction',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ],
                    'createdAt'    => [
                        'display' => false,
                    ],
                    'updatedAt'    => [
                        'display' => false,
                    ],
                    'status'       => [
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => NewsArticleTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ],
                ],
            ])
            ->add('publishedAt', 'sonata_type_datetime_picker', [
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => [
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ],
            ])
            ->add('publishEndedAt', 'sonata_type_datetime_picker', [
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => [
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ],
            ])
            ->add('widgets', 'infinite_form_polycollection', [
                'label'        => false,
                'types'        => [
                    'news_widget_text_type',
                    'news_widget_quote_type',
                    'news_widget_image_type',
                    'news_widget_image_dual_align_type',
                    'news_widget_video_youtube_type',
                ],
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ])
            ->add('theme', 'sonata_type_model_list', [
                'btn_delete' => false,
                'required'   => false,
            ])
            ->add('signature', null, [
                'help' => 'form.news.helper_signature',
            ])
            ->add('header', 'sonata_type_model_list', [
                'label'              => 'form.label_header_image',
                'help'               => 'form.news.helper_header_image',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete'         => false,
                'required'           => false,
            ])
            ->add('translate')
            ->add('translateOptions', 'choice', [
                'choices'            => News::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true,
            ])
            ->add('priorityStatus', 'choice', [
                'choices'                   => News::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ])
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, [
                'label' => false,
                'attr'  => [
                    'class' => 'hidden',
                ],
                'years' => range(1960, (int)date('Y') + 5),
            ])
            ->add('createdBy', null, [
                'label' => false,
                'attr'  => [
                    'class' => 'hidden',
                ],
            ])
            ->add('updatedAt', null, [
                'label' => false,
                'attr'  => [
                    'class' => 'hidden',
                ],
            ])
            ->add('updatedBy', null, [
                'label' => false,
                'attr'  => [
                    'class' => 'hidden',
                ],
            ])
            ->add('orangeType', 'choice', [
                'choices'  => [
                    'OCS'                 => 'OCS',
                    'Orange et le cinéma' => 'Orange et le cinéma',
                ],
                'required' => true,
                'expanded' => true,
                'multiple' => false,
            ])
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id');
    }
}

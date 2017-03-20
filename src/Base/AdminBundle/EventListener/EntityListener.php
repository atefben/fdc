<?php

namespace Base\AdminBundle\EventListener;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\EventWidgetQuoteTranslation;
use Base\CoreBundle\Entity\EventWidgetSubtitleTranslation;
use Base\CoreBundle\Entity\EventWidgetTextTranslation;
use Base\CoreBundle\Entity\EventWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetIntroTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetQuoteTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetSubtitleTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetTextTranslation;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSectionWidgetSubTitleTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSectionWidgetTypefiveTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSectionWidgetTypefourTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSectionWidgetTypeoneTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSectionWidgetTypethreeTranslation;
use Base\CoreBundle\Entity\FDCPageParticipateSectionWidgetTypetwoTranslation;
use Base\CoreBundle\Entity\FDCPagePrepareWidgetColumnTranslation;
use Base\CoreBundle\Entity\FDCPagePrepareWidgetImageTranslation;
use Base\CoreBundle\Entity\FDCPagePrepareWidgetPictoTranslation;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\InfoWidgetQuoteTranslation;
use Base\CoreBundle\Entity\InfoWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Base\CoreBundle\Entity\NewsWidgetQuoteTranslation;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Entity\NodeTranslation;
use Base\CoreBundle\Entity\OrangeWidgetFilmOCSTranslation;
use Base\CoreBundle\Entity\OrangeWidgetFilmStudioTranslation;
use Base\CoreBundle\Entity\OrangeWidgetMovieYoutubeTranslation;
use Base\CoreBundle\Entity\PressDownloadSectionWidgetArchiveTranslation;
use Base\CoreBundle\Entity\PressDownloadSectionWidgetDocumentTranslation;
use Base\CoreBundle\Entity\PressDownloadSectionWidgetVideoTranslation;
use Base\CoreBundle\Entity\PressGuideWidgetColumnTranslation;
use Base\CoreBundle\Entity\PressGuideWidgetImageTranslation;
use Base\CoreBundle\Entity\PressGuideWidgetPictoTranslation;
use Base\CoreBundle\Entity\StatementWidgetQuoteTranslation;
use Base\CoreBundle\Entity\StatementWidgetTextTranslation;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutubeTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Class EntityListener
 * @package Base\CoreBundle\Listener
 */
class EntityListener
{
    /**
     * @var bool
     */
    private $flush;

    private $locales;

    public function __construct()
    {
        $this->flush = false;
    }

    public function setLocales($locales)
    {
        $this->locales = $locales;
    }

    private $toTranslate = [];

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $allowedEntities = [
            'NewsArticle', 'NewsImage', 'NewsVideo', 'NewsAudio',
            'StatementArticle', 'StatementImage', 'StatementVideo', 'StatementAudio',
            'InfoArticle', 'InfoImage', 'InfoVideo', 'InfoAudio',
            'Homepage', 'PressHomepage',
            'MediaImageSimple',
            'MediaImage', 'MediaAudio', 'MediaVideo',
            'Event',
            'WebTv',
            'SocialWall', 'SocialGraph'
        ];
        $entityName = substr(strrchr(get_class($entity), '\\'), 1);

        // set festival year
        if (method_exists($entity, 'setFestival') && in_array($entityName, $allowedEntities)) {
            $em = $args->getEntityManager();

            $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
            if ($settings !== null) {
                $entity->setFestival($settings->getFestival());
            }
        }

        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setPublishedAt')) {
            $this->setPublishedAt($entity, false);
        }

        if (method_exists($entity, 'setTypeClone')) {
            $mapper = [
                'NewsArticle'      => 'article', 'NewsAudio' => 'audio', 'NewsImage' => 'image', 'NewsVideo' => 'video',
                'StatementArticle' => 'article', 'StatementAudio' => 'audio', 'StatementImage' => 'image', 'StatementVideo' => 'video',
                'InfoArticle'      => 'article', 'InfoAudio' => 'audio', 'InfoImage' => 'image', 'InfoVideo' => 'video',
            ];

            if (isset($mapper[$entityName])) {
                $entity->setTypeClone($mapper[$entityName]);
            }
        }

        if (method_exists($entity, 'getTranslate')) {
            $languages = ['en', 'zh', 'es'];
            if ($entity->getTranslate()) {
                foreach ($entity->getTranslateOptions() as $option) {
                    if (array_key_exists($option, $languages)) {
                        $translation = $entity->findTranslationByLocale($languages[$option]);
                        $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATION_PENDING);
                        $args->getEntityManager()->persist($translation);
                    }
                }
            }
        }

        $this->setPublishedOn($entity, $args);

        if ($entity instanceof Media && !$entity->getIgnoreListener()) {
            $entity->setThumbsGenerated(false);
        }
    }

    private function setPublishedOn($entity, $args)
    {
        if (method_exists($entity, 'getIsPublishedOnFDCEvent') && !($entity instanceof NodeTranslation)) {

            $em = $args->getEntityManager();
            $fdcEventSite = $em->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-evenementiel');
            $master = $entity->getTranslatable();
            $entityFr = $master->findTranslationByLocale('fr');
            $hasSite = false;
            $hasFrench = false;
            $hasLocale = false;

            $hasSiteCondition = false;
            $masterSites = method_exists($master, 'getSites') && $master->getSites();
            if ($masterSites) {
                $sites = $master->getSites();
                $hasSiteCondition = is_object($sites) && method_exists($sites, 'contains') && $sites->contains($fdcEventSite);
            }
            // has site
            if ($hasSiteCondition) {
                $hasSite = true;
            }

            if ($entityFr !== null) {
                // verify fr translation
                if (method_exists($entityFr, 'getStatus') &&
                    $entityFr->getStatus() == TranslateChildInterface::STATUS_PUBLISHED
                ) {
                    $hasFrench = true;
                }

                // verify locale
                $hasLocale = false;
                if ($entityFr === $entity) {
                    $hasLocale = true;
                } else {
                    if (method_exists($entity, 'getStatus') &&
                        $entity->getStatus() == TranslateChildInterface::STATUS_TRANSLATED
                    ) {
                        $hasLocale = true;
                    }
                }
            }
            if ($hasSite == true && $hasFrench == true && $hasLocale == true) {
                $entity->setIsPublishedOnFDCEvent(true);
            } else {
                $entity->setIsPublishedOnFDCEvent(false);
            }
        }
    }


    /**
     * @param $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {

        $this->applyChanges($args);

        $entity = $args->getEntity();
        $entityName = substr(strrchr(get_class($entity), '\\'), 1);

        if (method_exists($entity, 'getTranslate')) {
            if ($args->hasChangedField('translateOptions')) {
                $languages = ['en', 'zh', 'es'];
                foreach ($args->getNewValue('translateOptions') as $newOption) {
                    if (!in_array($newOption, $args->getOldValue('translateOptions'))) {
                        $translation = $entity->findTranslationByLocale($languages[$newOption]);
                        if ($translation->getStatus() == null) {
                            $this->toTranslate[] = $translation; // go to the post flush function to see the next operations
                        }
                    }
                }
            }
        }

        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setPublishedAt')) {
            $this->setPublishedAt($entity);
        }

        $this->setPublishedOn($entity, $args);

        if ($entity instanceof Media && !$entity->getIgnoreListener()) {
            $entity->setThumbsGenerated(false);
        }
    }

    protected function applyChanges(PreUpdateEventArgs $args)
    {
        $object = $args->getObject();
        if (method_exists($object, 'getApplyChanges') && method_exists($object, 'setApplyChanges')) {
            if (!$object->getApplyChanges()) {
                foreach (array_keys($args->getEntityChangeSet()) as $field) {
                    $args->setNewValue($field, $args->getOldValue($field));
                }
            }
        }
    }

    private function setFrenchVersion($entities, $entity, $entityName, $properties)
    {
        if (in_array($entityName, $entities)) {
            $parent = $entity->getTranslatable();
            foreach ($parent->getTranslations() as $trans) {
                foreach ($properties as $property) {
                    $property = ucfirst($property);
                    // introduction
                    if ($trans->{'get' . $property}() == '') {
                        $trans->{'set' . $property}($entity->{'get' . $property}());
                        $this->flush = true;
                    }
                }
            }
        }

    }

    /**
     * Set french version in all languages for multiples entities
     *
     * @param $entity
     * @param $entityName
     */
    private function setTransWysiwyg($entity, $entityName)
    {
        if (method_exists($entity, 'getLocale') && $entity->getLocale() == 'fr') {
            // news
            $entitiesNews = [
                'NewsArticleTranslation', 'NewsImageTranslation', 'NewsVideoTranslation', 'NewsAudioTranslation',
                'StatementArticleTranslation', 'StatementImageTranslation', 'StatementVideoTranslation', 'StatementAudioTranslation',
                'InfoArticleTranslation', 'InfoImageTranslation', 'InfoVideoTranslation', 'InfoAudioTranslation',
                'EventTranslation'
            ];
            $entitiesIntroduction = array_merge($entitiesNews, [
                'OrangeProgrammationOCSTranslation',
                'OrangeSeriesAndCieTranslation',
                'OrangeStudioTranslation',
                'OrangeVideoOnDemandTranslation'
            ]);
            $this->setFrenchVersion($entitiesIntroduction, $entity, $entityName, ['introduction']);
            // contact page
            $this->setFrenchVersion(['ContactPageTranslation'], $entity, $entityName, ['firstColumn', 'secondColumn', 'thirdColumn']);
            // faq page / fdc page footer / fdc page participate
            $entitiesContent = [
                'FAQPageTranslation', 'FDCPageFooterTranslation', 'FDCPageFooterTranslation',
            ];
            $this->setFrenchVersion($entitiesContent, $entity, $entityName, ['content']);
            // fdc page participate section
            $entitiesDescription = [
                'FDCPageParticipateSection'
            ];
            $this->setFrenchVersion($entitiesDescription, $entity, $entityName, ['description']);
            // fdc page prepare
            $this->setFrenchVersion(['FDCPagePreareTranslation'], $entity, $entityName, ['mainDescription', 'meetingDescription', 'informationDescription', 'serviceDescription']);
            // fdc page waiting
            $this->setFrenchVersion(['FDCPageWaitingTranslation'], $entity, $entityName, ['text']);
            // press accredit
            $this->setFrenchVersion(['PressAccreditTranslation'], $entity, $entityName, ['commonContent']);
            // press accredit procedure
            $this->setFrenchVersion(['PressAccreditProcedureTranslation'], $entity, $entityName, ['procedureContent']);
            // press homepage
            $this->setFrenchVersion(['PressHomepageTranslation'], $entity, $entityName, ['sectionStatisticDescription']);


            // widgets
            if (($key = array_search('fr', $this->locales)) !== false) {
                unset($this->locales[$key]);
            }

            $this->setWidgetsFrenchVersion(
                ['EventTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new EventWidgetQuoteTranslation(),
                        'widgetName'   => 'EventWidgetQuote',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new EventWidgetSubtitleTranslation(),
                        'widgetName'   => 'EventWidgetQuote',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new EventWidgetTextTranslation(),
                        'widgetName'   => 'EventWidgetText',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new EventWidgetVideoYoutubeTranslation(),
                        'widgetName'   => 'EventWidgetVideoYoutube',
                        'setters'      => [
                            'title',
                            'url'
                        ]
                    ],
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['FDCPageLaSelectionCannesClassicsTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetIntroTranslation(),
                        'widgetName'   => 'FDCPageLaSelectionCannesClassicsWidgetIntro',
                        'setters'      => [
                            'introduction'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetQuoteTranslation(),
                        'widgetName'   => 'FDCPageLaSelectionCannesClassicsWidgetQuote',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetSubtitleTranslation(),
                        'widgetName'   => 'FDCPageLaSelectionCannesClassicsWidgetSubtitle',
                        'setters'      => [
                            'subtitle',
                            'paragraph'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetTextTranslation(),
                        'widgetName'   => 'FDCPageLaSelectionCannesClassicsWidgetText',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation(),
                        'widgetName'   => 'FDCPageLaSelectionCannesClassicsWidgetVideoYoutube',
                        'setters'      => [
                            'url',
                            'title'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['FDCPageParticipateSectionTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new FDCPageParticipateSectionWidgetSubTitleTranslation(),
                        'widgetName'   => 'FDCPageParticipateSectionWidgetSubTitle',
                        'setters'      => [
                            'description',
                            'title'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypefiveTranslation(),
                        'widgetName'   => 'FDCPageParticipateSectionWidgetTypefive',
                        'setters'      => [
                            'oneDescription',
                            'twoDescription',
                            'threeDescription',
                            'fourDescription',
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypefourTranslation(),
                        'widgetName'   => 'FDCPageParticipateSectionWidgetTypefour',
                        'setters'      => [
                            'content',
                            'title'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypeoneTranslation(),
                        'widgetName'   => 'FDCPageParticipateSectionWidgetTypeone',
                        'setters'      => [
                            'content',
                            'title'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypethreeTranslation(),
                        'widgetName'   => 'FDCPageParticipateSectionWidgetTypethree',
                        'setters'      => [
                            'content',
                            'title'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypetwoTranslation(),
                        'widgetName'   => 'FDCPageParticipateSectionWidgetTypetwo',
                        'setters'      => [
                            'content',
                            'title',
                            'sponsorFirstName',
                            'sponsorFirstName',
                            'sponsorRole'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['FDCPagePrepareTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new FDCPagePrepareWidgetColumnTranslation(),
                        'widgetName'   => 'FDCPagePrepareWidgetColumn',
                        'setters'      => [
                            'btnLabel',
                            'title'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPagePrepareWidgetImageTranslation(),
                        'widgetName'   => 'FDCPagePrepareWidgetImage',
                        'setters'      => [
                            'content',
                            'title'
                        ]
                    ],
                    [
                        'widgetEntity' => new FDCPagePrepareWidgetPictoTranslation(),
                        'widgetName'   => 'FDCPagePrepareWidgetPicto',
                        'setters'      => [
                            'content',
                            'title',
                            'btnLabel'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['InfoArticleTranslation', 'InfoImageTranslation', 'InfoVideoTranslation', 'InfoAudioTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new InfoWidgetTextTranslation(),
                        'widgetName'   => 'InfoWidgetText',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new InfoWidgetQuoteTranslation(),
                        'widgetName'   => 'InfoWidgetQuote',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new InfoWidgetVideoYoutubeTranslation(),
                        'widgetName'   => 'InfoWidgetVideoYoutube',
                        'setters'      => [
                            'url',
                            'title'
                        ]
                    ],

                ]
            );

            $this->setWidgetsFrenchVersion(
                ['NewsArticleTranslation', 'NewsImageTranslation', 'NewsVideoTranslation', 'NewsAudioTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new NewsWidgetQuoteTranslation(),
                        'widgetName'   => 'NewsWidgetQuote',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new NewsWidgetTextTranslation(),
                        'widgetName'   => 'NewsWidgetText',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new NewsWidgetVideoYoutubeTranslation(),
                        'widgetName'   => 'NewsWidgetYoutube',
                        'setters'      => [
                            'title',
                            'url'
                        ]
                    ]
                ]
            );


            $this->setWidgetsFrenchVersion(
                ['OrangeAndCieTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new OrangeWidgetMovieYoutubeTranslation(),
                        'widgetName'   => 'OrangeWidgetMovieYoutube',
                        'setters'      => [
                            'title',
                            'subtitle'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['OrangeProgrammationOCSTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new OrangeWidgetFilmOCSTranslation(),
                        'widgetName'   => 'OrangeWidgetFilmOCS',
                        'setters'      => [
                            'legend',
                            'title',
                            'description'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['OrangeSeriesAndCieTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new OrangeWidgetFilmOCSTranslation(),
                        'widgetName'   => 'OrangeWidgetFilmOCS',
                        'setters'      => [
                            'legend',
                            'title',
                            'description'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['OrangeStudioTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new OrangeWidgetFilmStudioTranslation(),
                        'widgetName'   => 'OrangeWidgetFilmStudio',
                        'setters'      => [
                            'title',
                            'description'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['PressDownloadSectionTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new PressDownloadSectionWidgetArchiveTranslation(),
                        'widgetName'   => 'PressDownloadSectionWidgetArchive',
                        'setters'      => [
                            'label',
                            'copyright',
                            'btnLabel',
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new PressDownloadSectionWidgetDocumentTranslation(),
                        'widgetName'   => 'PressDownloadSectionWidgetDocument',
                        'setters'      => [
                            'label',
                            'copyright',
                            'btnLabel',
                            'secondBtnLabel',
                            'thirdBtnLabel',
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new PressDownloadSectionWidgetVideoTranslation(),
                        'widgetName'   => 'PressDownloadSectionWidgetVideo',
                        'setters'      => [
                            'label',
                            'copyright',
                            'btnLabel',
                            'secondBtnLabel'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['PressGuideTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new PressGuideWidgetColumnTranslation(),
                        'widgetName'   => 'PressGuideWidgetColumn',
                        'setters'      => [
                            'firstColumn',
                            'secondColumn',
                            'thirdColumn'
                        ]
                    ],
                    [
                        'widgetEntity' => new PressGuideWidgetImageTranslation(),
                        'widgetName'   => 'PressGuideWidgetImage',
                        'setters'      => [
                            'title',
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new PressGuideWidgetPictoTranslation(),
                        'widgetName'   => 'PressGuideWidgetPicto',
                        'setters'      => [
                            'title',
                            'content'
                        ]
                    ]
                ]
            );

            $this->setWidgetsFrenchVersion(
                ['StatementArticleTranslation', 'StatementImageTranslation', 'StatementVideoTranslation', 'StatementAudioTranslation'],
                $entity,
                $entityName,
                [
                    [
                        'widgetEntity' => new StatementWidgetTextTranslation(),
                        'widgetName'   => 'StatementWidgetText',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new StatementWidgetQuoteTranslation(),
                        'widgetName'   => 'StatementWidgetQuote',
                        'setters'      => [
                            'content'
                        ]
                    ],
                    [
                        'widgetEntity' => new StatementWidgetVideoYoutubeTranslation(),
                        'widgetName'   => 'StatementWidgetVideoYoutube',
                        'setters'      => [
                            'url',
                            'title'
                        ]
                    ]
                ]
            );

        }
    }

    private function setWidgetsFrenchVersion($entities, $entity, $entityName, $widgets)
    {
        if (in_array($entityName, $entities)) {
            $parent = $entity->getTranslatable();
            if (count($parent->getWidgets()) > 0) {
                foreach ($parent->getWidgets() as $parentWidget) {
                    $parentWidgetEntityName = substr(strrchr(get_class($parentWidget), '\\'), 1);
                    foreach ($widgets as $widget) {
                        if ($parentWidgetEntityName == $widget['widgetName']) {
                            // no easy way to get the fr translations
                            $translations = $parentWidget->getTranslations();
                            $frenchVersion = null;
                            foreach ($translations as $translation) {
                                if ($translation->getLocale() == 'fr') {
                                    $frenchVersion = $translation;
                                }
                            }
                            if ($frenchVersion !== null) {
                                foreach ($this->locales as $locale) {
                                    $trans = null;
                                    foreach ($translations as $translation) {
                                        if ($translation->getLocale() == $locale) {
                                            $trans = $translation;
                                        }
                                    }
                                    if ($trans == null) {
                                        $trans = clone $widget['widgetEntity'];
                                        $trans->setLocale($locale);
                                        $parentWidget->addTranslation($trans);
                                    }

                                    foreach ($widget['setters'] as $setter) {
                                        $setter = ucfirst($setter);
                                        if ($trans->{'get' . $setter}() == '') {
                                            $trans->{'set' . $setter}($frenchVersion->{'get' . $setter}());
                                            $this->flush = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    /**
     * @param $entity
     * @param bool $update
     */
    private function setPublishedAt($entity, $update = true)
    {
        if (method_exists($entity->getTranslatable(), 'setPublishedAt') &&
            method_exists($entity, 'getStatus') && $entity->getStatus() == NewsArticleTranslation::STATUS_PUBLISHED &&
            ($entity->getTranslatable()->getPublishedAt() === null) &&
            !($entity instanceof FilmFilmTranslation) &&
            !($entity instanceof FilmFilm)
        ) {
            $entity->getTranslatable()->setPublishedAt(new DateTime());
            if ($update == true) {
                $this->flush = true;
            }
        }

    }

    /**
     * @param PostFlushEventArgs $eventArgs
     */
    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->flush === true) {
            $this->flush = false;
            $eventArgs->getEntityManager()->flush();
        }

        if ($this->toTranslate) {
            $mustPersist = false;
            foreach ($this->toTranslate as $translation) {
                if ($translation->getStatus() == null) {
                    $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATION_PENDING);
                    $eventArgs->getEntityManager()->persist($translation);
                    $mustPersist = true;
                }

            }
            $this->toTranslate = [];
            if ($mustPersist) {
                $eventArgs->getEntityManager()->flush();
            }
        }
    }

    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $object = $eventArgs->getObject();

        $entity = $eventArgs->getEntity();
        $entityName = substr(strrchr(get_class($entity), '\\'), 1);

        if ($object instanceof Media) {
            if ($object->getParentAudioTranslation() || $object->getParentVideoTranslation()) {
                $this->flush = true;
            }
        }

        $this->setTransWysiwyg($entity, $entityName);
    }

    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $object = $eventArgs->getObject();

        $entity = $eventArgs->getEntity();
        $entityName = substr(strrchr(get_class($entity), '\\'), 1);

        if ($object instanceof Media) {
            if ($object->getParentAudioTranslation() || $object->getParentVideoTranslation()) {
                $this->flush = true;
            }
        }

        $this->setTransWysiwyg($entity, $entityName);
    }
}
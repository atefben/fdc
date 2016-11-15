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

    private $toTranslate = array();

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $allowedEntities = array(
            'NewsArticle', 'NewsImage', 'NewsVideo', 'NewsAudio',
            'StatementArticle', 'StatementImage', 'StatementVideo', 'StatementAudio',
            'InfoArticle', 'InfoImage', 'InfoVideo', 'InfoAudio',
            'Homepage', 'PressHomepage',
            'MediaImageSimple',
            'MediaImage', 'MediaAudio', 'MediaVideo',
            'Event',
            'WebTv',
            'SocialWall', 'SocialGraph'
        );
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
            $mapper = array(
                'NewsArticle' => 'article', 'NewsAudio' => 'audio', 'NewsImage' => 'image', 'NewsVideo' => 'video',
                'StatementArticle' => 'article', 'StatementAudio' => 'audio', 'StatementImage' => 'image', 'StatementVideo' => 'video',
                'InfoArticle' => 'article', 'InfoAudio' => 'audio', 'InfoImage' => 'image', 'InfoVideo' => 'video',
            );

            if (isset($mapper[$entityName])) {
                $entity->setTypeClone($mapper[$entityName]);
            }
        }

        if (method_exists($entity, 'getTranslate')) {
            $languages = array('en', 'zh', 'es');
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
        if (method_exists($entity, 'getIsPublishedOnFDCEvent')) {
            
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
                $languages = array('en', 'zh', 'es');
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
                    if ($trans->{'get'. $property}() == '') {
                        $trans->{'set'. $property}($entity->{'get'. $property}());
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
            $entitiesNews = array(
                'NewsArticleTranslation', 'NewsImageTranslation', 'NewsVideoTranslation', 'NewsAudioTranslation',
                'StatementArticleTranslation', 'StatementImageTranslation', 'StatementVideoTranslation', 'StatementAudioTranslation',
                'InfoArticleTranslation', 'InfoImageTranslation', 'InfoVideoTranslation', 'InfoAudioTranslation',
                'EventTranslation'
            );
            $entitiesIntroduction = array_merge($entitiesNews, array(
                'OrangeProgrammationOCSTranslation',
                'OrangeSeriesAndCieTranslation',
                'OrangeStudioTranslation',
                'OrangeVideoOnDemandTranslation'
            ));
            $this->setFrenchVersion($entitiesIntroduction, $entity, $entityName, array('introduction'));
            // contact page
            $this->setFrenchVersion(array('ContactPageTranslation'), $entity, $entityName, array('firstColumn', 'secondColumn', 'thirdColumn'));
            // faq page / fdc page footer / fdc page participate
            $entitiesContent = array(
                'FAQPageTranslation', 'FDCPageFooterTranslation', 'FDCPageFooterTranslation',
            );
            $this->setFrenchVersion($entitiesContent, $entity, $entityName, array('content'));
            // fdc page participate section
            $entitiesDescription = array(
                'FDCPageParticipateSection'
            );
            $this->setFrenchVersion($entitiesDescription, $entity, $entityName, array('description'));
            // fdc page prepare
            $this->setFrenchVersion(array('FDCPagePreareTranslation'), $entity, $entityName, array('mainDescription', 'meetingDescription', 'informationDescription', 'serviceDescription'));
            // fdc page waiting
            $this->setFrenchVersion(array('FDCPageWaitingTranslation'), $entity, $entityName, array('text'));
            // press accredit
            $this->setFrenchVersion(array('PressAccreditTranslation'), $entity, $entityName, array('commonContent'));
            // press accredit procedure
            $this->setFrenchVersion(array('PressAccreditProcedureTranslation'), $entity, $entityName, array('procedureContent'));
            // press homepage
            $this->setFrenchVersion(array('PressHomepageTranslation'), $entity, $entityName, array('sectionStatisticDescription'));


            // widgets
            if (($key = array_search('fr', $this->locales)) !== false) {
                unset($this->locales[$key]);
            }

            $this->setWidgetsFrenchVersion(
                array('EventTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new EventWidgetQuoteTranslation(),
                        'widgetName' => 'EventWidgetQuote',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new EventWidgetSubtitleTranslation(),
                        'widgetName' => 'EventWidgetQuote',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new EventWidgetTextTranslation(),
                        'widgetName' => 'EventWidgetText',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new EventWidgetVideoYoutubeTranslation(),
                        'widgetName' => 'EventWidgetVideoYoutube',
                        'setters' => array(
                            'title',
                            'url'
                        )
                    ),
                )
            );

            $this->setWidgetsFrenchVersion(
                array('FDCPageLaSelectionCannesClassicsTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetIntroTranslation(),
                        'widgetName' => 'FDCPageLaSelectionCannesClassicsWidgetIntro',
                        'setters' => array(
                            'introduction'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetQuoteTranslation(),
                        'widgetName' => 'FDCPageLaSelectionCannesClassicsWidgetQuote',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetSubtitleTranslation(),
                        'widgetName' => 'FDCPageLaSelectionCannesClassicsWidgetSubtitle',
                        'setters' => array(
                            'subtitle',
                            'paragraph'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetTextTranslation(),
                        'widgetName' => 'FDCPageLaSelectionCannesClassicsWidgetText',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageLaSelectionCannesClassicsWidgetVideoYoutubeTranslation(),
                        'widgetName' => 'FDCPageLaSelectionCannesClassicsWidgetVideoYoutube',
                        'setters' => array(
                            'url',
                            'title'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('FDCPageParticipateSectionTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new FDCPageParticipateSectionWidgetSubTitleTranslation(),
                        'widgetName' => 'FDCPageParticipateSectionWidgetSubTitle',
                        'setters' => array(
                            'description',
                            'title'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypefiveTranslation(),
                        'widgetName' => 'FDCPageParticipateSectionWidgetTypefive',
                        'setters' => array(
                            'oneDescription',
                            'twoDescription',
                            'threeDescription',
                            'fourDescription',
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypefourTranslation(),
                        'widgetName' => 'FDCPageParticipateSectionWidgetTypefour',
                        'setters' => array(
                            'content',
                            'title'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypeoneTranslation(),
                        'widgetName' => 'FDCPageParticipateSectionWidgetTypeone',
                        'setters' => array(
                            'content',
                            'title'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypethreeTranslation(),
                        'widgetName' => 'FDCPageParticipateSectionWidgetTypethree',
                        'setters' => array(
                            'content',
                            'title'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPageParticipateSectionWidgetTypetwoTranslation(),
                        'widgetName' => 'FDCPageParticipateSectionWidgetTypetwo',
                        'setters' => array(
                            'content',
                            'title',
                            'sponsorFirstName',
                            'sponsorFirstName',
                            'sponsorRole'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('FDCPagePrepareTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new FDCPagePrepareWidgetColumnTranslation(),
                        'widgetName' => 'FDCPagePrepareWidgetColumn',
                        'setters' => array(
                            'btnLabel',
                            'title'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPagePrepareWidgetImageTranslation(),
                        'widgetName' => 'FDCPagePrepareWidgetImage',
                        'setters' => array(
                            'content',
                            'title'
                        )
                    ),
                    array(
                        'widgetEntity' => new FDCPagePrepareWidgetPictoTranslation(),
                        'widgetName' => 'FDCPagePrepareWidgetPicto',
                        'setters' => array(
                            'content',
                            'title',
                            'btnLabel'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('InfoArticleTranslation', 'InfoImageTranslation', 'InfoVideoTranslation', 'InfoAudioTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new InfoWidgetTextTranslation(),
                        'widgetName' => 'InfoWidgetText',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new InfoWidgetQuoteTranslation(),
                        'widgetName' => 'InfoWidgetQuote',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new InfoWidgetVideoYoutubeTranslation(),
                        'widgetName' => 'InfoWidgetVideoYoutube',
                        'setters' => array(
                            'url',
                            'title'
                        )
                    ),

                )
            );

            $this->setWidgetsFrenchVersion(
                array('NewsArticleTranslation', 'NewsImageTranslation', 'NewsVideoTranslation', 'NewsAudioTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new NewsWidgetQuoteTranslation(),
                        'widgetName' => 'NewsWidgetQuote',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new NewsWidgetTextTranslation(),
                        'widgetName' => 'NewsWidgetText',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new NewsWidgetVideoYoutubeTranslation(),
                        'widgetName' => 'NewsWidgetYoutube',
                        'setters' => array(
                            'title',
                            'url'
                        )
                    )
                )
            );


            $this->setWidgetsFrenchVersion(
                array('OrangeAndCieTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new OrangeWidgetMovieYoutubeTranslation(),
                        'widgetName' => 'OrangeWidgetMovieYoutube',
                        'setters' => array(
                            'title',
                            'subtitle'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('OrangeProgrammationOCSTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new OrangeWidgetFilmOCSTranslation(),
                        'widgetName' => 'OrangeWidgetFilmOCS',
                        'setters' => array(
                            'legend',
                            'title',
                            'description'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('OrangeSeriesAndCieTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new OrangeWidgetFilmOCSTranslation(),
                        'widgetName' => 'OrangeWidgetFilmOCS',
                        'setters' => array(
                            'legend',
                            'title',
                            'description'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('OrangeStudioTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new OrangeWidgetFilmStudioTranslation(),
                        'widgetName' => 'OrangeWidgetFilmStudio',
                        'setters' => array(
                            'title',
                            'description'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('PressDownloadSectionTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new PressDownloadSectionWidgetArchiveTranslation(),
                        'widgetName' => 'PressDownloadSectionWidgetArchive',
                        'setters' => array(
                            'label',
                            'copyright',
                            'btnLabel',
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new PressDownloadSectionWidgetDocumentTranslation(),
                        'widgetName' => 'PressDownloadSectionWidgetDocument',
                        'setters' => array(
                            'label',
                            'copyright',
                            'btnLabel',
                            'secondBtnLabel',
                            'thirdBtnLabel',
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new PressDownloadSectionWidgetVideoTranslation(),
                        'widgetName' => 'PressDownloadSectionWidgetVideo',
                        'setters' => array(
                            'label',
                            'copyright',
                            'btnLabel',
                            'secondBtnLabel'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('PressGuideTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new PressGuideWidgetColumnTranslation(),
                        'widgetName' => 'PressGuideWidgetColumn',
                        'setters' => array(
                            'firstColumn',
                            'secondColumn',
                            'thirdColumn'
                        )
                    ),
                    array(
                        'widgetEntity' => new PressGuideWidgetImageTranslation(),
                        'widgetName' => 'PressGuideWidgetImage',
                        'setters' => array(
                            'title',
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new PressGuideWidgetPictoTranslation(),
                        'widgetName' => 'PressGuideWidgetPicto',
                        'setters' => array(
                            'title',
                            'content'
                        )
                    )
                )
            );

            $this->setWidgetsFrenchVersion(
                array('StatementArticleTranslation', 'StatementImageTranslation', 'StatementVideoTranslation', 'StatementAudioTranslation'),
                $entity,
                $entityName,
                array(
                    array(
                        'widgetEntity' => new StatementWidgetTextTranslation(),
                        'widgetName' => 'StatementWidgetText',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new StatementWidgetQuoteTranslation(),
                        'widgetName' => 'StatementWidgetQuote',
                        'setters' => array(
                            'content'
                        )
                    ),
                    array(
                        'widgetEntity' => new StatementWidgetVideoYoutubeTranslation(),
                        'widgetName' => 'StatementWidgetVideoYoutube',
                        'setters' => array(
                            'url',
                            'title'
                        )
                    )
                )
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
            $this->toTranslate = array();
            if ($mustPersist) {
                $eventArgs->getEntityManager()->flush();
            }
        }
    }

    public function postUpdate(LifecycleEventArgs $eventArgs) {
        $object =  $eventArgs->getObject();

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
        $object =  $eventArgs->getObject();

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
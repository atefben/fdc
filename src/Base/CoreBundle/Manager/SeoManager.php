<?php

namespace Base\CoreBundle\Manager;

use \DateTime;

/**
 * Class SeoManager
 * @package Base\CoreBundle\Manager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class SeoManager
{
    /**
     * @var integer
     */
    private $fdcYear;

    /**
     * @var string
     */
    private $fdcEventDomain;

    /**
     * @var string
     */
    private $fdcPressDomain;

    /**
     * @var string
     */
    private $fdcEventScheme;

    /**
     * @var string
     */
    private $fdcPressScheme;
    /**
     * @var string
     */
    private $socialTwitter;

    /**
     * @var string
     */
    private $localeDefaultTranslation;

    /**
     * sonataSeoPage
     *
     * @var mixed
     * @access private
     */
    private $sonataSeoPage;

    /**
     * @var Sonata\MediaBundle\Provider\ImageProvider
     */
    private $sonataProviderImage;

    /**
     * @var JMS\I18nRoutingBundle\Router\I18nRouter
     */
    private $router;


    /**
     * @param $sonataSeoPage
     * @param $fdcYear
     */
    public function __construct($fdcYear, $fdcEventDomain, $fdcPressDomain, $fdcEventScheme, $fdcPressScheme, $socialTwitter, $localeDefaultTranslation,
                                $sonataSeoPage, $sonataProviderImage, $router)
    {
        $this->fdcYear = $fdcYear;
        $this->fdcEventDomain = $fdcEventDomain;
        $this->fdcPressDomain = $fdcPressDomain;
        $this->fdcEventScheme = $fdcEventScheme;
        $this->fdcPressScheme = $fdcPressScheme;
        $this->socialTwitter = $socialTwitter;
        $this->localeDefaultTranslation = $localeDefaultTranslation;
        $this->sonataSeoPage = $sonataSeoPage;
        $this->sonataProviderImage = $sonataProviderImage;
        $this->router = $router;
    }

    /**
     * @param $news
     * @param $locale
     */
    public function setFDCEventPageNewsSeo($news, $locale)
    {
        $trans = $news->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');
            $intro = ($trans->getIntroduction() !== null) ? html_entity_decode($this->removeBannedChars($bannedChars, $trans->getIntroduction()), ENT_QUOTES) : '';

            $this->sonataSeoPage->setTitle("{$trans->getTitle()} - Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('name', 'description', $intro);

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'article');
            $this->sonataSeoPage->addMeta('property', 'og:title', $trans->getTitle());
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->fdcEventScheme. $this->fdcEventDomain. $this->router->generate('fdc_event_news_get', array(
               'slug' => $trans->getSlug()
            )));
            $this->sonataSeoPage->addMeta('property', 'og:description', strip_tags($trans->getIntroduction()));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $news->getUpdatedAt()->format(DateTime::ISO8601));

            // PICTURE
            $header = $news->getHeader()->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
            $transImage = $news->getHeader()->findTranslationByLocale($locale);
            if ($transImage->getFile() !== null) {
                $header = $transImage->getFile();
            }

            // OG PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'news_header_image_big');
            $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@'. substr(strrchr($this->socialTwitter, '/'), 1));
            $this->sonataSeoPage->addMeta('property', 'twitter:title', $trans->getTitle());
            $this->sonataSeoPage->addMeta('property', 'twitter:description', html_entity_decode($trans->getIntroduction()));

            // TWITTER PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'news_header_image_big');
            $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);

            // ARTICLE
            $this->sonataSeoPage->addMeta('property', 'article:author', ($news->getSignature() !== null) ? $news->getSignature() : '');
            $this->sonataSeoPage->addMeta('property', 'article:published_time', ($news->getPublishedAt()) ? $news->getPublishedAt()->format(DateTime::ISO8601) : '');
            $this->sonataSeoPage->addMeta('property', 'article:modified_time', $news->getUpdatedAt()->format(DateTime::ISO8601));


            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle("{$trans->getSeoTitle()}  - Festival de Cannes {$this->fdcYear}");
                $this->sonataSeoPage->addMeta('property', 'og:title', $trans->getSeoTitle());
                $this->sonataSeoPage->addMeta('property', 'twitter:title', $trans->getSeoTitle());
            }
            if ($trans->getSeoDescription() !== null) {
                $this->sonataSeoPage->addMeta('name', 'description', $trans->getSeoDescription());
                $this->sonataSeoPage->addMeta('property', 'og:description', $trans->getSeoDescription());
                $this->sonataSeoPage->addMeta('property', 'twitter:description', $trans->getSeoDescription());
            }
        }
    }

    /**
     * @param $statement
     * @param $locale
     */
    public function setFDCPressPageStatementSeo($statement, $locale)
    {
        $trans = $statement->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');
            $intro = ($trans->getIntroduction() !== null) ? html_entity_decode($this->removeBannedChars($bannedChars, $trans->getIntroduction()), ENT_QUOTES) : '';

            $this->sonataSeoPage->setTitle("{$trans->getTitle()} - Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('name', 'description', $intro);

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'article');
            $this->sonataSeoPage->addMeta('property', 'og:title', $trans->getTitle());
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->fdcPressScheme. $this->fdcPressDomain. $this->router->generate('fdc_press_statement_get', array(
                    'slug' => $trans->getSlug()
                )));
            $this->sonataSeoPage->addMeta('property', 'og:description', strip_tags($trans->getIntroduction()));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $statement->getUpdatedAt()->format(DateTime::ISO8601));

            // PICTURE
            $header = $statement->getHeader()->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
            $transImage = $statement->getHeader()->findTranslationByLocale($locale);
            if ($transImage->getFile() !== null) {
                $header = $transImage->getFile();
            }

            // OG PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'statement_header_image_big');
            $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@'. substr(strrchr($this->socialTwitter, '/'), 1));
            $this->sonataSeoPage->addMeta('property', 'twitter:title', $trans->getTitle());
            $this->sonataSeoPage->addMeta('property', 'twitter:description', html_entity_decode($trans->getIntroduction()));

            // TWITTER PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'statement_header_image_big');
            $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);

            // ARTICLE
            $this->sonataSeoPage->addMeta('property', 'article:author', ($statement->getSignature() !== null) ? $statement->getSignature() : '');
            $this->sonataSeoPage->addMeta('property', 'article:published_time', ($statement->getPublishedAt()) ? $statement->getPublishedAt()->format(DateTime::ISO8601) : '');
            $this->sonataSeoPage->addMeta('property', 'article:modified_time', $statement->getUpdatedAt()->format(DateTime::ISO8601));


            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle("{$trans->getSeoTitle()}  - Festival de Cannes {$this->fdcYear}");
                $this->sonataSeoPage->addMeta('property', 'og:title', $trans->getSeoTitle());
                $this->sonataSeoPage->addMeta('property', 'twitter:title', $trans->getSeoTitle());
            }
            if ($trans->getSeoDescription() !== null) {
                $this->sonataSeoPage->addMeta('name', 'description', $trans->getSeoDescription());
                $this->sonataSeoPage->addMeta('property', 'og:description', $trans->getSeoDescription());
                $this->sonataSeoPage->addMeta('property', 'twitter:description', $trans->getSeoDescription());
            }
        }
    }

    private function removeBannedChars($bannedChars, $string)
    {
        foreach ($bannedChars as $char) {
            $string = str_replace($char, '', $string);
            }

        return $string;
    }
}
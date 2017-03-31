<?php

namespace Base\CoreBundle\Manager;

use Base\CoreBundle\Entity\FDCPageAward;
use Base\CoreBundle\Entity\FDCPageFooter;
use Base\CoreBundle\Entity\FDCPageJury;
use Base\CoreBundle\Entity\FDCPageLaSelection;
use Base\CoreBundle\Entity\FDCPageNewsArticles;
use Base\CoreBundle\Entity\FDCPageNewsAudios;
use Base\CoreBundle\Entity\FDCPageNewsImages;
use Base\CoreBundle\Entity\FDCPageNewsVideos;
use Base\CoreBundle\Entity\FDCPagePrepare;
use Base\CoreBundle\Entity\FDCPageParticipate;
use Base\CoreBundle\Entity\FDCPageWebTvChannels;
use Base\CoreBundle\Entity\FDCPageWebTvLive;
use Base\CoreBundle\Entity\FDCPageWebTvTrailers;
use Base\CoreBundle\Entity\Homepage;
use Base\CoreBundle\Entity\PressDownload;
use Base\CoreBundle\Entity\PressProjection;
use Base\CoreBundle\Entity\PressStatementInfo;
use Base\CoreBundle\Entity\PressMediaLibrary;
use Base\CoreBundle\Entity\PressHomepage;
use Base\CoreBundle\Entity\PressAccredit;
use Base\CoreBundle\Entity\PressCinemaMap;
use Base\CoreBundle\Entity\PressGuide;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\WebTv;
use \DateTime;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints\Date;

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
     * @var \Sonata\MediaBundle\Provider\ImageProvider
     */
    private $sonataProviderImage;

    /**
     * @var \JMS\I18nRoutingBundle\Router\I18nRouter
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
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->fdcEventScheme . $this->fdcEventDomain . $this->router->generate('fdc_event_news_get', array(
                    'slug'   => $trans->getSlug(),
                    'format' => $trans->getTranslatable()->getNewsFormat()
                )));
            $this->sonataSeoPage->addMeta('property', 'og:description', strip_tags($trans->getIntroduction()));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $news->getUpdatedAt()->format(DateTime::ISO8601));

            // PICTURE
            $header = null;
            if ($news->getHeader() !== null) {
                $transImage = $news->getHeader()->findTranslationByLocale($locale);
                if ($transImage && $transImage->getFile() !== null) {
                    $header = $transImage->getFile();
                }
            } else if (method_exists($news, 'getGallery') && count($news->getGallery()->getMedias()) >= 1) {
                $media = $news->getGallery()->getMedias()->get(0);
                if ($media !== null) {
                    $media = $media->getMedia();
                    $header = $media->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
                    $transImage = $media->findTranslationByLocale($locale);
                    if ($transImage->getFile() !== null) {
                        $header = $transImage->getFile();
                    }
                }
            } else if (method_exists($news, 'getGallery') && count($news->getGallery()->getMedias()) >= 1) {
                $media = $news->getGallery()->getMedias()->get(0);
                if ($media !== null) {
                    $media = $media->getMedia();
                    $header = $media->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
                    $transImage = $media->findTranslationByLocale($locale);
                    if ($transImage->getFile() !== null) {
                        $header = $transImage->getFile();
                    }
                }
            }

            if (strpos(get_class($news), 'Video') !== false) {
                if ($news->getVideo() !== null && $news->getVideo()->findTranslationByLocale($this->localeDefaultTranslation) != null) {
                    $imageAmazonUrl = 'http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/'. $news->getVideo()->findTranslationByLocale($this->localeDefaultTranslation)->getImageAmazonUrl();
                }
            }

            if ($header !== null) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'media_image_572x362');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);
            } else if (isset($imageAmazonUrl)) {
                $this->sonataSeoPage->addMeta('property', 'og:image', $imageAmazonUrl);
            }

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));
            $this->sonataSeoPage->addMeta('property', 'twitter:title', $trans->getTitle());
            $this->sonataSeoPage->addMeta('property', 'twitter:description', html_entity_decode($trans->getIntroduction()));

            // TWITTER PICTURE
            if ($header !== null) {
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'media_image_572x362');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            } else if (isset($imageAmazonUrl)) {
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $imageAmazonUrl);
            }

            // ARTICLE
            $this->sonataSeoPage->addMeta('property', 'article:author', ($news->getSignature() !== null) ? $news->getSignature() : '');
            $this->sonataSeoPage->addMeta('property', 'article:published_time', ($news->getPublishedAt()) ? $news->getPublishedAt()->format(DateTime::ISO8601) : '');
            $this->sonataSeoPage->addMeta('property', 'article:modified_time', $news->getUpdatedAt()->format(DateTime::ISO8601));


            // overload default value by the one set on the article
            // PICTURE
            $header = $news->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param $page
     * @param $locale
     */
    public function setFDCEventPageAllNewsSeo($page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($page instanceof FDCPageNewsArticles) {
            $route = 'fdc_event_news_getarticles';
        } else if ($page instanceof FDCPageNewsAudios) {
            $route = 'fdc_event_news_getaudios';
        } else if ($page instanceof FDCPageNewsImages) {
            $route = 'fdc_event_news_getphotos';
        } else if ($page instanceof FDCPageNewsVideos) {
            $route = 'fdc_event_news_getvideos';
        }

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate($route, array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle($trans->getSeoTitle());
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
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->fdcPressScheme . $this->fdcPressDomain . $this->router->generate('fdc_press_statement_get', array(
                    'slug' => $trans->getSlug()
                )));
            $this->sonataSeoPage->addMeta('property', 'og:description', strip_tags($trans->getIntroduction()));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $statement->getUpdatedAt()->format(DateTime::ISO8601));

            // PICTURE
            $news = $statement;
            $header = null;
            if ($news->getHeader() !== null) {
                $header = $news->getHeader()->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
                $transImage = $news->getHeader()->findTranslationByLocale($locale);
                if ($transImage->getFile() !== null) {
                    $header = $transImage->getFile();
                }
            } else if (method_exists($news, 'getGallery') && count($news->getGallery()->getMedias()) >= 1) {
                $media = $news->getGallery()->getMedias()->get(0);
                if ($media !== null) {
                    $media = $media->getMedia();
                    $header = $media->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
                    $transImage = $media->findTranslationByLocale($locale);
                    if ($transImage->getFile() !== null) {
                        $header = $transImage->getFile();
                    }
                }
            } else if (method_exists($news, 'getGallery') && count($news->getGallery()->getMedias()) >= 1) {
                $media = $news->getGallery()->getMedias()->get(0);
                if ($media !== null) {
                    $media = $media->getMedia();
                    $header = $media->findTranslationByLocale($this->localeDefaultTranslation)->getFile();
                    $transImage = $media->findTranslationByLocale($locale);
                    if ($transImage->getFile() !== null) {
                        $header = $transImage->getFile();
                    }
                } else if (strpos(get_class($news), 'Video') !== false) {
                    if ($news->getVideo() !== null && $news->getVideo()->findTranslationByLocale($this->localeDefaultTranslation) != null) {
                        $imageAmazonUrl = 'http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/'. $news->getVideo()->findTranslationByLocale($this->localeDefaultTranslation)->getImageAmazonUrl();
                    }
                }
            }

            if ($header !== null) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'media_image_572x362');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);
            } else if (isset($imageAmazonUrl)) {
                $mediaPath = $imageAmazonUrl;
                $this->sonataSeoPage->addMeta('property', 'og:image', $imageAmazonUrl);
            }

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));
            $this->sonataSeoPage->addMeta('property', 'twitter:title', $trans->getTitle());
            $this->sonataSeoPage->addMeta('property', 'twitter:description', html_entity_decode($trans->getIntroduction()));

            // TWITTER PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, 'statement_header_image_big');
            if (isset($mediaPath)) {
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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


    /**
     * @param FDCPageWebTvChannels $page
     * @param $locale
     */
    public function setFDCEventPageFDCPageWebTvChannelsSeo(FDCPageWebTvChannels $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_channels', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle($trans->getSeoTitle());
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
     * @param Homepage $homepage
     * @param $locale
     */
    public function setFDCEventPageHomepageSeo(Homepage $homepage, $locale)
    {
        $trans = $homepage->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_channels', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $homepage->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $homepage->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle($trans->getSeoTitle());
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
     * @param WebTv $webTv
     * @param $locale
     */
    public function setFDCEventPageWebTvSeo(WebTv $webTv, $locale)
    {
        $trans = $webTv->findTranslationByLocale($locale);

        if ($trans !== null) {
            $this->sonataSeoPage->setTitle("{$trans->getName()}  - Festival de Cannes {$this->fdcYear}");

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:title', $trans->getName());
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_channels', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $webTv->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'og:title', $trans->getName());
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $webTv->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param FDCPageWebTvLives $page
     * @param $locale
     */
    public function setFDCEventPageFDCPageWebTvLiveSeo(FDCPageWebTvLive $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {


            $title = strip_tags($trans->getTitle());
            $this->sonataSeoPage->setTitle($title);
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_live', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param FDCPageWebTvTrailers $page
     * @param $locale
     */
    public function setFDCEventPageFDCPageWebTvTrailersSeo(FDCPageWebTvTrailers $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_live', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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

    public function setFDCEventPageFDCPageWebTvTrailerSeo($route, $title, $description, DateTime $updatedAt = null, $image = null)
    {
        // title
        $this->sonataSeoPage->setTitle($title);
        $this->sonataSeoPage->addMeta('property', 'og:title', $title);
        $this->sonataSeoPage->addMeta('property', 'twitter:title', $title);
        // Descripton
        $this->sonataSeoPage->addMeta('name', 'description', $description);
        $this->sonataSeoPage->addMeta('property', 'og:description', $description);
        $this->sonataSeoPage->addMeta('property', 'twitter:description', $description);

        // OG PARAMS
        $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
        $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
        $this->sonataSeoPage->addMeta('property', 'og:url', $route);
        if ($updatedAt) {
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $updatedAt->format(DateTime::ISO8601));
        }

        // TWITTER
        $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
        $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
        $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

        // PICTURE
        if ($image) {
            // OG PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($image, $image->getContext() . '_small');
            $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

            // TWITTER PICTURE
            $mediaPath = $this->sonataProviderImage->generatePublicUrl($image, $image->getContext() . '_small');
            $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
        }
    }
    /**
     * @param (FDCPageLaSelection|FDCPageLaSelectionCannesClassics|FDCPageLaSelectionCinemaPlage) $page
     * @param $locale
     */
    public function setFDCEventPageFDCPageLaSelectionSeo($page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_live', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressDownload $page
     * @param $locale
     */
    public function setFDCPressPagePressDownloadSeo(PressDownload $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_media_download', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressMediaLibrary $page
     * @param $locale
     * @param $sectionId
     */
    public function setFDCPressPagePressMediaLibrarySeo(PressMediaLibrary $page, $locale, $sectionId)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_media_main', array('sectionId' => $sectionId), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param FDCPageJury $jury
     * @param $locale
     */
    public function setFDCEventPageJurySeo(FDCPageJury $jury, $locale)
    {
        $trans = $jury->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_channels', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $jury->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $jury->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle($trans->getSeoTitle());
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
     * @param FDCPageFooter $pageFooter
     * @param $locale
     */
    public function setFDCPageFooterSeo(FDCPageFooter $pageFooter, $locale)
    {
        $trans = $pageFooter->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_channels', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $pageFooter->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $pageFooter->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle($trans->getSeoTitle());
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
     * @param FDCPageAward $award
     * @param $locale
     */
    public function setFDCEventPageAwardSeo(FDCPageAward $award, $locale)
    {
        $trans = $award->findTranslationByLocale($locale);

        if ($trans !== null) {
            $bannedChars = array('&nbsp;');

            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_television_channels', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $award->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $award->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

            // overload default value by the one set on the article
            if ($trans->getSeoTitle() !== null) {
                $this->sonataSeoPage->setTitle($trans->getSeoTitle());
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
     * @param PressProjection $page
     * @param $locale
     */
    public function setFDCPressPagePressProjectionSeo(PressProjection $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_agenda_scheduling', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressStatementInfo $page
     * @param $locale
     */
    public function setFDCPressPagePressStatementInfoSeo(PressStatementInfo $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_news_list', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressAccredit $page
     * @param $locale
     */
    public function setFDCPressPagePressAccreditSeo(PressAccredit $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_accredit_main', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressCinemaMap $page
     * @param $locale
     */
    public function setFDCPressPagePressCinemaMapSeo(PressCinemaMap $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_agenda_room', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressHomepage $page
     * @param $locale
     */
    public function setFDCPressPagePressHomepageSeo(PressHomepage $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_news_home', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param PressGuide $page
     * @param $locale
     */
    public function setFDCPressPagePressGuideSeo(PressGuide $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_press_guide_main', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param FDCPagePrepare $page
     * @param $locale
     */
    public function setFDCPagePrepareSeo(FDCPagePrepare $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');
            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_participate_prepare', array(), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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
     * @param FDCPageParticipate $page
     * @param $locale
     */
    public function setFDCPageParticipateSeo(FDCPageParticipate $page, $locale)
    {
        $trans = $page->findTranslationByLocale($locale);

        if ($trans !== null) {
            // OG PARAMS
            $this->sonataSeoPage->addMeta('property', 'og:site_name', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'og:type', 'website');


            $this->sonataSeoPage->addMeta('property', 'og:url', $this->router->generate('fdc_event_participate_getpage', array('slug' => $trans->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL));
            $this->sonataSeoPage->addMeta('property', 'og:updated_time', $page->getUpdatedAt()->format(DateTime::ISO8601));

            // TWITTER
            $this->sonataSeoPage->addMeta('property', 'twitter:card', 'summary_large_image');
            $this->sonataSeoPage->addMeta('property', 'twitter:site', "Festival de Cannes {$this->fdcYear}");
            $this->sonataSeoPage->addMeta('property', 'twitter:creator', '@' . substr(strrchr($this->socialTwitter, '/'), 1));

            // PICTURE
            $header = $page->getSeoFile();
            if ($header) {
                // OG PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'og:image', $mediaPath);

                // TWITTER PICTURE
                $mediaPath = $this->sonataProviderImage->generatePublicUrl($header, $header->getContext() . '_small');
                $this->sonataSeoPage->addMeta('property', 'twitter:image', $mediaPath);
            }

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

}
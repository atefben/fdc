<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Gallery;
use Application\Sonata\MediaBundle\Entity\GalleryHasMedia;
use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class OldFdcDatabaseImportCommand extends ContainerAwareCommand
{
    const TYPE_QUOTIDIEN = 23102;
    const TYPE_NEWS_FESTIVAL = 23120;
    const TYPE_NEWS_CONFERENCE = 23121;

    private $langs = array('fr', 'en', 'es', 'cn');

    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc')
            ->setDescription('Impot old fdc database data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm = $this->getContainer()->get('doctrine')->getManager();
        $mediaManager = $this->getContainer()->get('sonata.media.manager.media');

        $output->writeln('<info>Import Article Quotidien...</info>');
        $this->importArticleQuotidien($dm, $mediaManager, $output);
    }

    private function importArticleQuotidien($dm, $mediaManager, $output)
    {
        $element = $dm->getRepository('BaseCoreBundle:OldArticle')->findOneById(61996);
        $oldArticles[0] = $element;

        /*$oldArticles = $dm->getRepository('BaseCoreBundle:OldArticle')->findBy(array(
            'articleTypeId' => self::TYPE_QUOTIDIEN,
            'published' => true
        ), array('id' => 'ASC'));*/

        $mapperFields = array(
            'title' => 'title',
        );

        $totalSaved = 0;
        $entities = array();

        $oldArticlesTotal = count($oldArticles);
        foreach ($oldArticles as $oldArticleKey => $oldArticle) {
            $output->writeln('<comment>#'. $oldArticle->getId(). ' - '. ($oldArticleKey + 1). '/'. $oldArticlesTotal. '</comment>');
            $oldArticleTranslations = $dm->getRepository('BaseCoreBundle:OldArticleI18n')->findById($oldArticle->getId());

            // has french translation
            $hasFrenchTranslation = $this->hasFrenchTranslation($oldArticleTranslations, $output);
            if ($hasFrenchTranslation == false) {
                continue;
            }

            // is valid matching
            $matching = $this->isQuotidienMatching($oldArticle, $oldArticleTranslations, $dm, $output);
            if ($matching == false) {
                continue;
            }

            // old news
            $news = $dm->getRepository('BaseCoreBundle:NewsArticle')->findOneByOldNewsId($oldArticle->getId());
            // set values
            if ($news == null) {
                $news = new NewsArticle();
            }
            $news->setOldNewsTable('OldNews');
            $news->setOldNewsId($oldArticle->getId());
            $news->setCreatedAt($oldArticle->getCreatedAt());
            $news->setUpdatedAt($oldArticle->getCreatedAt());

            $festival = $dm->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($oldArticle->getCreatedAt()->format('Y'));
            $news->setFestival($festival);

            // loop translations
            foreach ($oldArticleTranslations as $oldArticleTranslation) {
                $output->writeln('<comment>add Translation '. $oldArticleTranslation->getCulture(). '</comment>');
                if (in_array($oldArticleTranslation->getCulture(), $this->langs)) {
                    $newsTrans = $news->findTranslationByLocale($oldArticleTranslation->getCulture());
                    if ($newsTrans == null) {
                        $newsTrans = new NewsArticleTranslation();
                        $newsTrans->setLocale($oldArticleTranslation->getCulture());
                        $newsTrans->setCreatedAt($news->getCreatedAt());
                        $newsTrans->setUpdatedAt($news->getCreatedAt());
                        $newsTrans->setIsPublishedOnFDCEvent(true);
                        $news->addTranslation($newsTrans);
                        if ($oldArticleTranslation->getCulture() == 'fr') {
                            $newsTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                        } else {
                            $newsTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                        }
                    }

                    foreach ($mapperFields as $oldField => $field) {
                        $newsTrans->{'set'. ucfirst($field)}($oldArticleTranslation->{'get'. ucfirst($oldField)}());
                    }

                    // Image header / image accroche
                    if ($oldArticleTranslation->getImageResume()) {
                        if ($news->getHeader() == null) {
                            $media = new Media();
                            $img = $this->imagecreatefromfile('http://www.festival-cannes.fr/assets/Image/Pages/' . $oldArticleTranslation->getImageResume(), $output);
                            $media->setName($oldArticleTranslation->getImageResume());
                            $media->setBinaryContent($img);
                            $media->setEnabled(true);
                            $media->setProviderReference($oldArticleTranslation->getImageResume());
                            $media->setContext('media_image');
                            $media->setProviderStatus(1);
                            $media->setProviderName('sonata.media.provider.image');
                            $mediaManager->save($media);
                            $img = new MediaImage();

                            $imgTrans = $img->findTranslationByLocale($oldArticleTranslation->getCulture());
                            if ($imgTrans == null) {
                                $imgTrans = new MediaImageTranslation();
                            }
                            $imgTrans->setTranslatable($img);
                            $imgTrans->setFile($media);
                            $imgTrans->setLegend($oldArticleTranslation->getTitleImageResume());
                            $imgTrans->setLocale($oldArticleTranslation->getCulture());
                            $img->addTranslation($imgTrans);

                            $news->setHeader($img);
                        }
                    } else {
                        $output->writeln('<error>No image resume found</error>');
                    }

                    // widget text / annonce
                    if ($oldArticleTranslation->getBody() != null) {
                        if ($news->getWidgets()->count() == 0) {
                            $widgetText = new NewsWidgetText();
                            $widgetText->setPosition(1);
                        } else {
                            $widgets = $news->getWidgets();
                            $widgetText = $widgets->get(0);
                        }

                        $widgetTextTranslation = new NewsWidgetTextTranslation();
                        if ($widgetText->findTranslationByLocale($oldArticleTranslation->getCulture()) != null) {
                            $widgetTextTranslation = $widgetText->findTranslationByLocale($oldArticleTranslation->getCulture());
                        }
                        $widgetTextTranslation->setLocale($oldArticleTranslation->getCulture());
                        $widgetTextTranslation->setContent($oldArticleTranslation->getBody());
                        $widgetTextTranslation->setTranslatable($widgetText);
                        $widgetText->addTranslation($widgetTextTranslation);

                        if ($widgetText->getId() == null) {
                            $news->addWidget($widgetText);
                        }
                    }

                    // widget video youtube / youtube link / description
                    if ($oldArticleTranslation->getYoutubeLink() != null ||
                        $oldArticleTranslation->getYoutubeLinkDescription() != null) {
                            $widgetVideoYoutube = new NewsWidgetVideoYoutube();
                            $widgetVideoYoutube->setPosition(2);
                            foreach ($news->getWidgets() as $widget) {
                                if (strpos(get_class($widget), 'NewsWidgetVideoYoutube')) {
                                    $widgetVideoYoutube = $widget;
                                    break;
                                }
                            }

                            $widgetVideoYoutubeTranslation = new NewsWidgetVideoYoutubeTranslation();
                            if ($widgetVideoYoutube->findTranslationByLocale($oldArticleTranslation->getCulture()) != null) {
                                $widgetVideoYoutubeTranslation = $widgetVideoYoutube->findTranslationByLocale($oldArticleTranslation->getCulture());
                            }

                            $widgetVideoYoutubeTranslation->setLocale($oldArticleTranslation->getCulture());
                            $widgetVideoYoutubeTranslation->setUrl($oldArticleTranslation->getYoutubeLink());
                            $widgetVideoYoutubeTranslation->setTitle($oldArticleTranslation->getYoutubeLinkDescription());
                            $widgetVideoYoutubeTranslation->setTranslatable($widgetVideoYoutube);
                            if ($widgetVideoYoutube->getId() == null) {
                                $news->addWidget($widgetVideoYoutube);
                            }
                    }

                    // widget photo / association image
                    $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                        'id' => $oldArticle->getId(),
                        'objectClass' => 'Image'
                    ), array('order' => 'ASC'));
                    if (count($oldArticleAssociations) > 0) {
                        $widgetImage = new NewsWidgetImage();
                        $widgetImage->setPosition(3);
                        foreach ($news->getWidgets() as $widget) {
                            if (strpos(get_class($widget), 'NewsWidgetImage')) {
                                $widgetImage = $widget;
                                break;
                            }
                        }

                        $gallery = new Gallery();
                        $gallery->setName($oldArticleTranslation->getMosaiqueTitle());
                        if ($widgetImage->getGallery() != null) {
                            $gallery = $widgetImage->getGallery();
                        }
                        $widgetImage->setGallery($gallery);
                    }
                    if (isset($widgetImage) && $widgetImage->getId() == null) {
                        foreach ($oldArticleAssociations as $association) {
                            $image = $dm->getRepository('BaseCoreBundle:OldMedia')->findOneById($association->getObjectId());

                            $media = new Media();
                            $img = $this->imagecreatefromfile('http://www.festival-cannes.fr/assets/Image/General/' . $image->getFilename(), $output);
                            $media->setName($image->getFilename());
                            $media->setBinaryContent($img);
                            $media->setEnabled(true);
                            $media->setProviderReference($image->getFilename());
                            $media->setContext('media_image');
                            $media->setProviderStatus(1);
                            $media->setProviderName('sonata.media.provider.image');
                            $mediaManager->save($media);

                            $img = new MediaImage();
                            $imgTrans = $img->findTranslationByLocale($oldArticleTranslation->getCulture());
                            if ($imgTrans == null) {
                                $imgTrans = new MediaImageTranslation();
                            }
                            $imgTrans->setTranslatable($img);
                            $imgTrans->setFile($media);
                            $imgTrans->setLegend($oldArticleTranslation->getTitleImageResume());
                            $imgTrans->setLocale($oldArticleTranslation->getCulture());
                            $img->addTranslation($imgTrans);
                        }

                        if ($widgetImage->getId() == null) {
                            $news->addWidget($widgetImage);
                        }
                    }

                    // association film
                    $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findBy(array(
                        'id' => $oldArticle->getId(),
                        'objectClass' => 'Film'
                    ));
                    foreach ($oldArticleAssociations as $association) {
                        $filmFilm = $dm->getRepository('BaseCoreBundle:FilmFilm')->findOneById($association->getObjectId());
                        if ($filmFilm == null) {
                            $output->writeln("<error>Film #{$association->getObjectId()} not found</error>");
                        } else {
                            $found = false;
                            foreach ($news->getAssociatedFilms() as $associated) {
                                if ($associated->getAssociation()->getId() == $filmFilm->getId()) {
                                    $found = true;
                                }
                            }
                            if ($found == false) {
                                $associated = new NewsFilmFilmAssociated();
                                $associated->setNews($news);
                                $associated->setAssociation($filmFilm);
                                $news->addAssociatedFilm($associated);
                            }
                        }
                    }
                }
            }

            if ($news->getId() == null) {
                $dm->persist($news);
            }
            $entities[] = $news;
            $output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            if ($totalSaved % 10 == 0) {
                $output->writeln('<info>Saved !</info>');
                $dm->flush();
                $this->updateAcl($entities, 'base.admin.news_article', $output);
                $entities = array();
            }
        }

        $output->writeln('<info>Total saved: '. $totalSaved. '</info>');
        $dm->flush();
        $this->updateAcl($entities, 'base.admin.news_article', $output);
    }

    private function isQuotidienMatching($oldArticle, $oldArticleTranslations, $dm, $output)
    {
        // first case
        if ($oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2001 && $oldArticle->getCreatedAt()->format('Y') <= 2006) {
            return true;
        }

        // second case
        if ($oldArticle->getCreatedAt() != false &&
            $oldArticle->getCreatedAt()->format('Y') >= 2007 && $oldArticle->getCreatedAt()->format('Y') <= 2015) {
            $hasConference = false;
            foreach ($oldArticleTranslations as $trans) {
                $title = $this->removeAccents($trans->getTitle());
                if ($trans->getCulture() == 'fr' && (stripos($title, 'conference') !== false)) {
                    $hasConference = true;
                }
            }

            if ($hasConference == true) {
                $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldArticleAssociation')->findOneBy(array(
                    'id' => $oldArticle->getId(),
                    'objectClass' => 'Film'
                ));

                if (count($oldArticleAssociations) > 0) {
                    return true;
                }
            }
        }

        $output->writeln('<error>Doesn\'t match</error>');

        return false;
    }

    private function hasFrenchTranslation($oldArticleTranslations, $output)
    {
        foreach ($oldArticleTranslations as $trans) {
            if ($trans->getCulture() == 'fr') {
                return true;
            }
        }

        $output->writeln('<error>Doesn\'t have french translation</error>');

        return false;
    }

    private function removeAccents($string)
    {
        if ( !preg_match('/[\x80-\xff]/', $string) )
            return $string;

        $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
            chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
            chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
            chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
            chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
            chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
            chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
            chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
            chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
            chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
            chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
            chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
            chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
            chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
            chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
            chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
            chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
            chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
            chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
            chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
            chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
            chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
            chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
            chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
            chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
            chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
            chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
            chr(195).chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
            chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
            chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
            chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
            chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
            chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
            chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
            chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
            chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
            chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
            chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
            chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
            chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
            chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
            chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
            chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
            chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
            chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
            chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
            chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
            chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
            chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
            chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
            chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
            chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
            chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
            chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
            chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
            chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
            chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
            chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
            chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
            chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
            chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
            chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
            chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
            chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
            chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
            chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
            chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
            chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
            chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
            chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
            chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
            chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
            chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
            chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
            chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
            chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
            chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
            chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
            chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
            chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
            chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
            chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
            chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
            chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
            chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
            chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
            chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
            chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
            chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
            chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
            chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }

    private function imagecreatefromfile($filename, $output) {
        $file = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/'. md5($filename). '.'. pathinfo( $filename, PATHINFO_EXTENSION);
        $im = imagecreatefromstring(file_get_contents($filename));

        switch (strtolower(pathinfo( $filename, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($im, $file);
                break;

            case 'png':
                imagepng($im, $file);
                break;

            default:
                $output->writeln("extension doesnt exist {$filename}");
                break;
        }
    }

    private function updateAcl($entities, $service, $output)
    {
        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get($service);
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        foreach ($entities as $key => $object) {
            $objectIdentity = ObjectIdentity::fromDomainObject($object);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
            $adminSecurityHandler->updateAcl($acl);
            $output->writeln('Update Acl for: ' . $object->getId());
            unset($object);
        }
    }
}
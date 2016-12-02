<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class OldFdcDatabaseImportCommand extends ContainerAwareCommand
{
    const TYPE_QUOTIDIEN = 23102;
    const TYPE_NEWS_FESTIVAL = 23120;
    const TYPE_NEWS_CONFERENCE = 23121;
    const TYPE_COMMUNIQUE = 23109;

    const MEDIA_GALLERY_QUOTIDIEN_DIAPORAMA = 1;
    const MEDIA_GALLERY_PHOTOGRAPHER_EYES = 2;

    const MEDIA_TYPE_IMAGE = 1;
    const MEDIA_TYPE_AUDIO = 3;

    const MEDIA_QUOTIDIEN_AUDIO = 1;

    const VIDEO_TYPE_FESTIVAL_TV = 1;

    private $langs = array('fr', 'en', 'es', 'zh');
    private $entitiesCount = array();
    private $doNotPublish = false;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;


    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc')
            ->setDescription('Import old fdc database data')
            ->addOption('associated-news', null, InputOption::VALUE_NONE, 'Import only associated news')
            ->addOption('count', null, InputOption::VALUE_NONE, 'Count entities total')
            ->addOption('only-create', null, InputOption::VALUE_NONE, 'Create only new entities')
            ->addOption('only-articles', null, InputOption::VALUE_NONE, 'Only import articles')
            ->addOption('only-medias', null, InputOption::VALUE_NONE, 'Only import medias')
            ->addOption('theme', null, InputOption::VALUE_OPTIONAL, 'Default Theme')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm = $this->getContainer()->get('doctrine')->getManager();
        $mediaManager = $this->getContainer()->get('sonata.media.manager.media');

        $themeId = $input->getOption('theme');

        $onlyArticles = $input->getOption('only-articles');
        $onlyMedias = $input->getOption('only-medias');

        $newsImporter = $this->getContainer()->get('old_import.news_importer');
        $infoImporter = $this->getContainer()->get('old_import.info_importer');
        $statementImporter = $this->getContainer()->get('old_import.statement_importer');
        $classicsImporter = $this->getContainer()->get('old_import.classics_importer');

        $newsImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
        $infoImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
        $statementImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);
        $classicsImporter->setInput($input)->setOutput($output)->setDefaultThemeId($themeId);

        if ($onlyArticles) {
            $infoImporter->importInfos();
            $statementImporter->importStatements();
            $newsImporter->importNews();
            $classicsImporter->importClassics();
        } elseif ($onlyMedias) {
            $this->importMediaImage($dm, $mediaManager, $output, $input);
            $this->importMediaAudio($dm, $mediaManager, $output, $input);
        }
    }

    private function importMediaAudio($dm, $mediaManager, OutputInterface $output, InputInterface $input)
    {
        $output->writeln('<info>Import Media Audio ...</info>');

        /*$element = $dm->getRepository('BaseCoreBundle:OldMedia')->findOneById(15626);
        $oldMedias[0] = $element;*/

        // case one
        // Publier dans "Quotidien - Audios"
        // Film associé
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.fileClass = :file_class')
            ->andWhere('m.published = :published')
            ->setParameter('file_class', self::MEDIA_TYPE_AUDIO)
            ->setParameter('published', self::MEDIA_QUOTIDIEN_AUDIO)
            ->getQuery()
            ->getResult()
        ;

        $oldMediasSelected = array();
        foreach ($oldMedias as $oldMedia) {
            $oldArticleAssociations = $dm->getRepository('BaseCoreBundle:OldMediaAssociation')->findBy(array(
                'id'          => $oldMedia->getId(),
                'objectClass' => 'Film',
            ))
            ;
            if (count($oldArticleAssociations) > 0) {
                $oldMediasSelected[] = $oldMedia;
            }
        }

        $this->importMediaAudioLoop($oldMediasSelected, $dm, $mediaManager, $output, $input, false);
    }

    private function importMediaAudioLoop($oldMedias, $dm, $mediaManager, OutputInterface $output, InputInterface $input, $addSiteCorporate = true)
    {
        $totalSaved = 0;
        $optionCount = $input->getOption('count');
        $onlyCreate = $input->getOption('only-create');
        $siteFDCCorporate = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-institutionnel');
        $siteFDCEvent = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-evenementiel');
        $entities = array();
        $oldMediasTotal = count($oldMedias);

        foreach ($oldMedias as $oldMediaKey => $oldMedia) {
            $output->writeln('<comment>#' . $oldMedia->getId() . ' - ' . ($oldMediaKey + 1) . '/' . $oldMediasTotal . '</comment>');
            $output->writeln('<info>#' . $oldMedia->getId() . ' is matching.</info>');

            // old news
            $mediaAudio = $dm->getRepository('BaseCoreBundle:MediaAudio')->findOneByOldMediaId($oldMedia->getId());
            if ($onlyCreate == true && $mediaAudio != null) {
                continue;
            }
            // set values
            if ($mediaAudio == null) {
                $mediaAudio = new MediaAudio();
            }
            $mediaAudio->setOldMediaId($oldMedia->getId());

            $festival = $dm->getRepository('BaseCoreBundle:FilmFestival')->findOneByYear($oldMedia->getCreatedAt()->format('Y'));
            $mediaAudio->setFestival($festival);

            if ($addSiteCorporate == true) {
                if (!$mediaAudio->getSites()->contains($siteFDCCorporate)) {
                    $mediaAudio->addSite($siteFDCCorporate);
                }
            }
            /*if (!$mediaAudio->getSites()->contains($siteFDCEvent)) {
                $mediaAudio->addSite($siteFDCEvent);
            }*/
            /* remove site fdc event after testing
            if ($mediaAudio->getSites()->contains($siteFDCEvent)) {
                $mediaAudio->removeSite($siteFDCEvent);
            }*/

            $dm->persist($mediaAudio);
            $dm->flush();

            $oldMediaTranslations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findById($oldMedia->getId());
            foreach ($oldMediaTranslations as $oldMediaTrans) {
                $culture = ($oldMediaTrans->getCulture() == 'cn') ? 'zh' : $oldMediaTrans->getCulture();
                if (!in_array($culture, $this->langs)) {
                    continue;
                }
                $audioTrans = $mediaAudio->findTranslationByLocale($culture);

                // file
                if ($oldMediaTrans->getHdFormatFilename() != null) {
                    $code = $oldMediaTrans->getHdFormatFilename();
                    $audioPath = 'http://www.festival-cannes.fr/' . trim($code);
                }

                if ($code != null) {
                    if ($audioTrans != null && $audioTrans->getFile() != null) {
                        $media = $audioTrans->getFile();
                    } else {
                        $media = new Media();
                    }

                    $file = $this->createAudio($audioPath, $output);
                    if ($file == null) {
                        break;
                    }
                    $media->setName($oldMediaTrans->getLabel());
                    $media->setBinaryContent($file);
                    $media->setEnabled(true);
                    $media->setProviderReference($oldMediaTrans->getLabel());
                    $media->setContext('media_audio');
                    $media->setProviderStatus(1);
                    $media->setProviderName('sonata.media.provider.audio');
                    $mediaManager->save($media, 'media_audio', 'sonata.media.provider.audio');

                    if ($audioTrans == null) {
                        $audioTrans = new MediaAudioTranslation();
                    }
                    $audioTrans->setLocale($culture);
                    $audioTrans->setFile($media);
                    $audioTrans->setTranslatable($mediaAudio);
                    $audioTrans->setTitle($oldMediaTrans->getLabel());
                    $audioTrans->setJobMp3State(MediaAudioTranslation::ENCODING_STATE_READY);
                    $audioTrans->setTranslatable($mediaAudio);
                } else {
                    $output->writeln("<error>Audio code not found for Object id #{$oldMediaTrans->getId()}</error>");
                }

                // image
                if ($oldMediaTrans->getFilenameThumbnail() != null) {
                    $url = 'http://www.festival-cannes.fr/assets/Audio/General/thumbnails/' . $oldMediaTrans->getFilenameThumbnail();
                    $file = $this->imagecreatefromfile($url, $output);

                    if ($file !== null) {
                        $mediaImage = $mediaAudio->getImage();

                        if ($mediaImage == null) {
                            $mediaImage = new MediaImage();
                        }
                        if ($mediaImage !== null && $mediaImage->findTranslationByLocale($culture)) {
                            $mediaImageTrans = $mediaImage->findTranslationByLocale($culture);
                        } else {
                            $mediaImageTrans = new MediaImageTranslation();
                            $mediaImageTrans->setLocale($culture);
                            $mediaImageTrans->setTranslatable($mediaImage);
                        }
                        $mediaImageTrans->setCopyright($oldMediaTrans->getThumbnailCopyright());
                        $mediaAudio->setImage($mediaImage);
                        if ($mediaImageTrans->getFile() == null) {
                            $imgTitle = array(
                                'fr' => 'photo',
                                'en' => 'photo',
                                'es' => 'foto',
                                'zh' => '照片',
                            );
                            $media = new Media();
                            $media->setContentType('image/jpeg');
                            $media->setName($imgTitle[$culture]);
                            $media->setBinaryContent($file);
                            $media->setEnabled(true);
                            $media->setProviderReference($oldMediaTrans->getFilenameThumbnail());
                            $media->setContext('media_image');
                            $media->setProviderStatus(1);
                            $media->setProviderName('sonata.media.provider.image');
                            $mediaManager->save($media, 'media_image', 'sonata.media.provider.image');
                            $mediaImageTrans->setFile($media);
                        }
                    }
                }

                $publishedAt = $oldMedia->getPublishFor();
                $mediaAudio->setPublishedAt($publishedAt);
            }

            $oldMediaAssociations = $dm->getRepository('BaseCoreBundle:OldMediaAssociation')->findBy(array(
                'id'          => $oldMedia->getId(),
                'objectClass' => 'Film',
            ))
            ;

            foreach ($oldMediaAssociations as $oldMediaAssoc) {
                $filmFilm = $dm->getRepository('BaseCoreBundle:FilmFilm')->findOneById($oldMediaAssoc->getObjectId());
                if ($filmFilm == null) {
                    $output->writeln("<error>Film #{$oldMediaAssoc->getObjectId()} not found</error>");
                } else {
                    $found = false;
                    foreach ($mediaAudio->getAssociatedFilms() as $associated) {
                        if ($associated->getAssociation()->getId() == $filmFilm->getId()) {
                            $found = true;
                        }
                    }
                    if ($found == false) {
                        $associated = new MediaAudioFilmFilmAssociated();
                        $associated->setMediaAudio($mediaAudio);
                        $associated->setAssociation($filmFilm);
                        $mediaAudio->addAssociatedFilm($associated);
                    }
                }
            }

            $entities[] = $mediaAudio;
            $output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            if ($totalSaved % 100 == 0) {
                $output->writeln('<info>Saved !</info>');
                $dm->flush();
                $this->updateAcl($entities, 'base.admin.media_audio', $output);
                $entities = array();
            }
        }

        if ($optionCount) {
            dump($this->entitiesCount);
        } else {
            $output->writeln('<info>Total saved: ' . $totalSaved . '</info>');
            $dm->flush();
            $this->updateAcl($entities, 'base.admin.media_audio', $output);
        }
    }


    private function importMediaImage($dm, $mediaManager, OutputInterface $output, InputInterface $input)
    {
        $output->writeln('<info>Import Media Image...</info>');

        /*$element = $dm->getRepository('BaseCoreBundle:OldArticle')->findOneById(60596);
        $oldArticles[0] = $element;*/

        // case one
        // Galerie Quotidien - Diaporama
        // id > 7816
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.id >= 7816')
            ->andWhere('m.fileClass = :file_class')
            ->andWhere('m.published = :published')
            ->setParameter('file_class', self::MEDIA_TYPE_IMAGE)
            ->setParameter('published', self::MEDIA_GALLERY_QUOTIDIEN_DIAPORAMA)
            ->getQuery()
            ->getResult()
        ;
        $this->importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input);

        // case third
        // Galerie Oeil du photographe
        // id > 11802
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.id >= 11802')
            ->andWhere('m.published = :published')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter('file_class', self::MEDIA_TYPE_IMAGE)
            ->setParameter('published', self::MEDIA_GALLERY_PHOTOGRAPHER_EYES)
            ->getQuery()
            ->getResult()
        ;
        $this->importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input);

        // case fourth
        // Galerie Oeil du photographe
        // id < 11802
        $oldMedias = $dm->getRepository('BaseCoreBundle:OldMedia')->createQueryBuilder('m')
            ->where('m.id < 11802')
            ->andWhere('m.published = :published')
            ->andWhere('m.fileClass = :file_class')
            ->setParameter('file_class', self::MEDIA_TYPE_IMAGE)
            ->setParameter('published', self::MEDIA_GALLERY_PHOTOGRAPHER_EYES)
            ->getQuery()
            ->getResult()
        ;
        $this->importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input, false);
    }

    private function importMediaImageLoop($oldMedias, $dm, $mediaManager, $output, $input, $addSiteCorporate = true)
    {
        $totalSaved = 0;
        $optionAssociatedNews = $input->getOption('associated-news');
        $optionCount = $input->getOption('count');
        $onlyCreate = $input->getOption('only-create');
        $siteFDCCorporate = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-institutionnel');
        $siteFDCEvent = $dm->getRepository('BaseCoreBundle:Site')->findOneBySlug('site-evenementiel');
        $entities = array();
        $oldMediasTotal = count($oldMedias);

        foreach ($oldMedias as $oldMediaKey => $oldMedia) {
            $output->writeln('<comment>#' . $oldMedia->getId() . ' - ' . ($oldMediaKey + 1) . '/' . $oldMediasTotal . '</comment>');
            $output->writeln('<info>#' . $oldMedia->getId() . ' is matching.</info>');

            // old news
            $mediaImage = $dm->getRepository('BaseCoreBundle:MediaImage')->findOneByOldMediaId($oldMedia->getId());
            if ($onlyCreate == true && $mediaImage != null) {
                continue;
            }
            // set values
            if ($mediaImage == null) {
                $mediaImage = new MediaImage();
            }

            $url = 'http://www.festival-cannes.fr/assets/Image/General/' . $oldMedia->getFilename();
            $file = $this->imagecreatefromfile($url, $output);

            if ($file != null) {
                $media = ($mediaImage->findTranslationByLocale('fr') != null && $mediaImage->findTranslationByLocale('fr')->getFile() != null) ? $mediaImage->findTranslationByLocale('fr')->getFile() : new Media();
            } else {
                $media = new Media();
            }
            if ($addSiteCorporate == true) {
                if (!$mediaImage->getSites()->contains($siteFDCCorporate)) {
                    $mediaImage->addSite($siteFDCCorporate);
                }
            }
            /*if (!$mediaImage->getSites()->contains($siteFDCEvent)) {
                $mediaImage->addSite($siteFDCEvent);
            }*/
            /* remove site fdc event after testing
            if ($mediaImage->getSites()->contains($siteFDCEvent)) {
                $mediaImage->removeSite($siteFDCEvent);
            }*/
            $mediaImage->setOldMediaId($oldMedia->getId());
            $saved = false;
            if ($media->getId() == null && $oldMedia->getFilename()) {
                $media->setContentType('image/jpeg');
                $media->setName($oldMedia->getFilename());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($oldMedia->getFilename());
                $media->setContext('media_image');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.image');
                $mediaManager->save($media, 'media_image', 'sonata.media.provider.image');
                $saved = true;
            }

            $oldMediaTranslations = $dm->getRepository('BaseCoreBundle:OldMediaI18n')->findById($oldMedia->getId());
            foreach ($oldMediaTranslations as $oldMediaTrans) {
                $culture = ($oldMediaTrans->getCulture() == 'cn') ? 'zh' : $oldMediaTrans->getCulture();
                if (!in_array($culture, $this->langs)) {
                    continue;
                }
                $imgTrans = $mediaImage->findTranslationByLocale($culture);
                if ($imgTrans == null) {
                    $imgTrans = new MediaImageTranslation();
                    $mediaImage->addTranslation($imgTrans);
                }
                if ($culture == 'fr') {
                    $imgTrans->setStatus(NewsArticleTranslation::STATUS_PUBLISHED);
                } else {
                    $imgTrans->setStatus(NewsArticleTranslation::STATUS_TRANSLATED);
                }
                if ($saved == true && $culture == 'fr') {
                    $imgTrans->setFile($media);
                }
                $imgTrans->setTranslatable($mediaImage);
                $imgTitle = array(
                    'fr' => 'photo',
                    'en' => 'photo',
                    'es' => 'foto',
                    'zh' => '照片',
                );
                $imgTrans->setLegend(($oldMediaTrans->getLabel() != null) ? $oldMediaTrans->getLabel() : $imgTitle[$culture]);
                $imgTrans->setCopyright($oldMediaTrans->getCopyright());
                $imgTrans->setLocale($culture);
                $imgTrans->setisPublishedOnFDCEvent(1);

                $publishedAt = $oldMedia->getPublishFor();
                $publishedAt->setTime($oldMedia->getHourOrder(), 0);
                $mediaImage->setPublishedAt($publishedAt);
            }

            if ($mediaImage->getId() == null) {
                $dm->persist($mediaImage);
            }
            $entities[] = $mediaImage;
            $output->writeln('<info>To be saved...</info>');
            $totalSaved++;

            if ($totalSaved % 100 == 0) {
                $output->writeln('<info>Saved !</info>');
                $dm->flush();
                $this->updateAcl($entities, 'base.admin.media_image', $output);
                $entities = array();
            }
        }

        if ($optionCount) {
            dump($this->entitiesCount);
        } else {
            $output->writeln('<info>Total saved: ' . $totalSaved . '</info>');
            $dm->flush();
            $this->updateAcl($entities, 'base.admin.media_image', $output);
        }
    }

    private function getWidget($news, $pos, $entity)
    {
        if ($news->getWidgets()->get($pos - 1) !== null) {
            return $news->getWidgets()->get($pos - 1);
        }

        return $entity;
    }

    private function updateCount($functionName, $pos)
    {
        $this->entitiesCount[$functionName][$pos] = (isset($this->entitiesCount[$functionName][$pos])) ?
            ($this->entitiesCount[$functionName][$pos] + 1) : 1;
    }

    private function imagecreatefromfile($filename, OutputInterface $output)
    {
        $file = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/image/' . md5($filename) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        $content = @file_get_contents($filename);
        $output->writeln('Creating file: ' . $filename);
        if ($content === false) {
            $output->writeln("<error>Cant get file: {$filename}</error>");
            return;
        }
        $im = imagecreatefromstring($content);

        switch (strtolower(pathinfo($filename, PATHINFO_EXTENSION))) {
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

        return $file;
    }

    private function createVideo($url, OutputInterface $output)
    {
        $path = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/video/' . md5($url) . '.' . pathinfo($url, PATHINFO_EXTENSION);

        $output->writeln('Video path: ' . $path);
        if (!file_exists($path)) {
            $output->writeln('Download video: ' . $url);
            $data = @file_get_contents($url);
            if ($data === false) {
                $output->writeln("<error>Cant get file: {$url}</error>");
                return;
            }

            $file = fopen($path, "w+");
            fwrite($file, $data);
            fclose($file);
        }

        return $path;
    }

    private function createAudio($url, OutputInterface $output)
    {
        $path = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/old/audio/' . md5($url) . '.' . pathinfo($url, PATHINFO_EXTENSION);

        $output->writeln('Audio path: ' . $path);
        if (!file_exists($path)) {
            $output->writeln('Download audio: ' . $url);
            $data = @file_get_contents($url);
            if ($data === false) {
                $output->writeln("<error>Cant get file: {$url}</error>");
                return;
            }

            $file = fopen($path, "w+");
            fwrite($file, $data);
            fclose($file);
        }

        return $path;
    }

    private function updateAcl($entities, $service, OutputInterface $output)
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
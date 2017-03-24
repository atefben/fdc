<?php

namespace Base\CoreBundle\OldImport;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioFilmFilmAssociated;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoFilmFilmAssociated;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\OldArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Entity\OldMedia;
use Base\CoreBundle\Entity\OldMediaI18n;
use Base\CoreBundle\Entity\Site;
use Base\CoreBundle\Entity\Theme;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class Importer
{
    const TYPE_QUOTIDIEN = 23102;
    const TYPE_NEWS_FESTIVAL = 23120;
    const TYPE_NEWS_CONFERENCE = 23121;
    const TYPE_COMMUNIQUE = 23109;
    const TYPE_EDITO = 23119;
    const TYPE_WALL = 23123;
    const TYPE_TOO = 23118;
    const TYPE_PHOTOPGRAH_EYE = 23135;
    const TYPE_WEB_PAGE = 1;

    const MEDIA_GALLERY_QUOTIDIEN_DIAPORAMA = 1;
    const MEDIA_GALLERY_PHOTOGRAPHER_EYES = 2;

    const MEDIA_TYPE_IMAGE = 1;
    const MEDIA_TYPE_VIDEO = 2;
    const MEDIA_TYPE_AUDIO = 3;

    const MEDIA_QUOTIDIEN_AUDIO = 1;
    const MEDIA_QUOTIDIEN_VIDEO = 1;

    const VIDEO_TYPE_FESTIVAL_TV = 1;

    /**
     * @var array
     */
    protected $langs = ['fr', 'en', 'es', 'zh'];

    /**
     * @var array
     */
    protected $entitiesCount = [];

    /**
     * @var bool
     */
    protected $doNotPublish = false;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var Theme
     */
    protected $defaultTheme;
    protected $defaultThemeId;

    protected $associateMovie = true;
    protected $selfkitAmazonUrl;

    public function __construct(ContainerInterface $container, $selfkitAmazonUrl)
    {
        $this->container = $container;
        $this->selfkitAmazonUrl = $selfkitAmazonUrl;
    }

    /**
     * @return ObjectManager
     */
    public function getManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    /**
     * @return MediaManager
     */
    public function getMediaManager()
    {
        return $this->container->get('sonata.media.manager.media');
    }

    /**
     * @param InputInterface $input
     * @return $this
     */
    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }

    /**
     * @param OutputInterface $output
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }

    protected function removeAccents($string)
    {
        if (!preg_match('/[\x80-\xff]/', $string))
            return $string;

        $chars = [
            // Decompositions for Latin-1 Supplement
            chr(195) . chr(128) => 'A', chr(195) . chr(129) => 'A',
            chr(195) . chr(130) => 'A', chr(195) . chr(131) => 'A',
            chr(195) . chr(132) => 'A', chr(195) . chr(133) => 'A',
            chr(195) . chr(135) => 'C', chr(195) . chr(136) => 'E',
            chr(195) . chr(137) => 'E', chr(195) . chr(138) => 'E',
            chr(195) . chr(139) => 'E', chr(195) . chr(140) => 'I',
            chr(195) . chr(141) => 'I', chr(195) . chr(142) => 'I',
            chr(195) . chr(143) => 'I', chr(195) . chr(145) => 'N',
            chr(195) . chr(146) => 'O', chr(195) . chr(147) => 'O',
            chr(195) . chr(148) => 'O', chr(195) . chr(149) => 'O',
            chr(195) . chr(150) => 'O', chr(195) . chr(153) => 'U',
            chr(195) . chr(154) => 'U', chr(195) . chr(155) => 'U',
            chr(195) . chr(156) => 'U', chr(195) . chr(157) => 'Y',
            chr(195) . chr(159) => 's', chr(195) . chr(160) => 'a',
            chr(195) . chr(161) => 'a', chr(195) . chr(162) => 'a',
            chr(195) . chr(163) => 'a', chr(195) . chr(164) => 'a',
            chr(195) . chr(165) => 'a', chr(195) . chr(167) => 'c',
            chr(195) . chr(168) => 'e', chr(195) . chr(169) => 'e',
            chr(195) . chr(170) => 'e', chr(195) . chr(171) => 'e',
            chr(195) . chr(172) => 'i', chr(195) . chr(173) => 'i',
            chr(195) . chr(174) => 'i', chr(195) . chr(175) => 'i',
            chr(195) . chr(177) => 'n', chr(195) . chr(178) => 'o',
            chr(195) . chr(179) => 'o', chr(195) . chr(180) => 'o',
            chr(195) . chr(181) => 'o', chr(195) . chr(182) => 'o',
            chr(195) . chr(182) => 'o', chr(195) . chr(185) => 'u',
            chr(195) . chr(186) => 'u', chr(195) . chr(187) => 'u',
            chr(195) . chr(188) => 'u', chr(195) . chr(189) => 'y',
            chr(195) . chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196) . chr(128) => 'A', chr(196) . chr(129) => 'a',
            chr(196) . chr(130) => 'A', chr(196) . chr(131) => 'a',
            chr(196) . chr(132) => 'A', chr(196) . chr(133) => 'a',
            chr(196) . chr(134) => 'C', chr(196) . chr(135) => 'c',
            chr(196) . chr(136) => 'C', chr(196) . chr(137) => 'c',
            chr(196) . chr(138) => 'C', chr(196) . chr(139) => 'c',
            chr(196) . chr(140) => 'C', chr(196) . chr(141) => 'c',
            chr(196) . chr(142) => 'D', chr(196) . chr(143) => 'd',
            chr(196) . chr(144) => 'D', chr(196) . chr(145) => 'd',
            chr(196) . chr(146) => 'E', chr(196) . chr(147) => 'e',
            chr(196) . chr(148) => 'E', chr(196) . chr(149) => 'e',
            chr(196) . chr(150) => 'E', chr(196) . chr(151) => 'e',
            chr(196) . chr(152) => 'E', chr(196) . chr(153) => 'e',
            chr(196) . chr(154) => 'E', chr(196) . chr(155) => 'e',
            chr(196) . chr(156) => 'G', chr(196) . chr(157) => 'g',
            chr(196) . chr(158) => 'G', chr(196) . chr(159) => 'g',
            chr(196) . chr(160) => 'G', chr(196) . chr(161) => 'g',
            chr(196) . chr(162) => 'G', chr(196) . chr(163) => 'g',
            chr(196) . chr(164) => 'H', chr(196) . chr(165) => 'h',
            chr(196) . chr(166) => 'H', chr(196) . chr(167) => 'h',
            chr(196) . chr(168) => 'I', chr(196) . chr(169) => 'i',
            chr(196) . chr(170) => 'I', chr(196) . chr(171) => 'i',
            chr(196) . chr(172) => 'I', chr(196) . chr(173) => 'i',
            chr(196) . chr(174) => 'I', chr(196) . chr(175) => 'i',
            chr(196) . chr(176) => 'I', chr(196) . chr(177) => 'i',
            chr(196) . chr(178) => 'IJ', chr(196) . chr(179) => 'ij',
            chr(196) . chr(180) => 'J', chr(196) . chr(181) => 'j',
            chr(196) . chr(182) => 'K', chr(196) . chr(183) => 'k',
            chr(196) . chr(184) => 'k', chr(196) . chr(185) => 'L',
            chr(196) . chr(186) => 'l', chr(196) . chr(187) => 'L',
            chr(196) . chr(188) => 'l', chr(196) . chr(189) => 'L',
            chr(196) . chr(190) => 'l', chr(196) . chr(191) => 'L',
            chr(197) . chr(128) => 'l', chr(197) . chr(129) => 'L',
            chr(197) . chr(130) => 'l', chr(197) . chr(131) => 'N',
            chr(197) . chr(132) => 'n', chr(197) . chr(133) => 'N',
            chr(197) . chr(134) => 'n', chr(197) . chr(135) => 'N',
            chr(197) . chr(136) => 'n', chr(197) . chr(137) => 'N',
            chr(197) . chr(138) => 'n', chr(197) . chr(139) => 'N',
            chr(197) . chr(140) => 'O', chr(197) . chr(141) => 'o',
            chr(197) . chr(142) => 'O', chr(197) . chr(143) => 'o',
            chr(197) . chr(144) => 'O', chr(197) . chr(145) => 'o',
            chr(197) . chr(146) => 'OE', chr(197) . chr(147) => 'oe',
            chr(197) . chr(148) => 'R', chr(197) . chr(149) => 'r',
            chr(197) . chr(150) => 'R', chr(197) . chr(151) => 'r',
            chr(197) . chr(152) => 'R', chr(197) . chr(153) => 'r',
            chr(197) . chr(154) => 'S', chr(197) . chr(155) => 's',
            chr(197) . chr(156) => 'S', chr(197) . chr(157) => 's',
            chr(197) . chr(158) => 'S', chr(197) . chr(159) => 's',
            chr(197) . chr(160) => 'S', chr(197) . chr(161) => 's',
            chr(197) . chr(162) => 'T', chr(197) . chr(163) => 't',
            chr(197) . chr(164) => 'T', chr(197) . chr(165) => 't',
            chr(197) . chr(166) => 'T', chr(197) . chr(167) => 't',
            chr(197) . chr(168) => 'U', chr(197) . chr(169) => 'u',
            chr(197) . chr(170) => 'U', chr(197) . chr(171) => 'u',
            chr(197) . chr(172) => 'U', chr(197) . chr(173) => 'u',
            chr(197) . chr(174) => 'U', chr(197) . chr(175) => 'u',
            chr(197) . chr(176) => 'U', chr(197) . chr(177) => 'u',
            chr(197) . chr(178) => 'U', chr(197) . chr(179) => 'u',
            chr(197) . chr(180) => 'W', chr(197) . chr(181) => 'w',
            chr(197) . chr(182) => 'Y', chr(197) . chr(183) => 'y',
            chr(197) . chr(184) => 'Y', chr(197) . chr(185) => 'Z',
            chr(197) . chr(186) => 'z', chr(197) . chr(187) => 'Z',
            chr(197) . chr(188) => 'z', chr(197) . chr(189) => 'Z',
            chr(197) . chr(190) => 'z', chr(197) . chr(191) => 's',
        ];

        $string = strtr($string, $chars);

        return $string;
    }

    protected function updateCount($functionName, $pos)
    {
        $this->entitiesCount[$functionName][$pos] = (isset($this->entitiesCount[$functionName][$pos])) ?
            ($this->entitiesCount[$functionName][$pos] + 1) : 1;
    }

    protected function updateAcl($entities, $service)
    {
        $adminSecurityHandler = $this->container->get('sonata.admin.security.handler');
        $modelAdmin = $this->container->get($service);
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        foreach ($entities as $key => $object) {
            $objectIdentity = ObjectIdentity::fromDomainObject($object);
            $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
            if (is_null($acl)) {
                $acl = $adminSecurityHandler->createAcl($objectIdentity);
            }
            $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
            $adminSecurityHandler->updateAcl($acl);
            $this->output->writeln('Update Acl for: ' . $object->getId());
            unset($object);
        }
    }

    protected function getWidget($news, $pos, $entity)
    {
        if ($news->getWidgets()->get($pos - 1) !== null) {
            return $news->getWidgets()->get($pos - 1);
        }

        return $entity;
    }


    protected function createImage($url)
    {
        return $this->createFile($url, 'image');
    }


    /**
     * @param $url
     * @return string
     */
    protected function createAudio($url)
    {
        return $this->createFile($url, 'audio');
    }

    /**
     * @param $url
     * @return null|string
     */
    protected function createVideo($url)
    {
        return $this->createFile($url, 'video');
    }

    /**
     * @param string $url
     * @param string $type
     * @return null|string
     */
    private function createFile($url, $type)
    {
        $folder = $this->container->get('kernel')->getRootDir() . "/../web/uploads/old/$type/";
        exec("mkdir -p $folder");
        $file = md5($url) . '.' . pathinfo($url, PATHINFO_EXTENSION);

        if (is_file("$folder$file") && filesize("$folder$file")) {
            return $folder . $file;
        }
        exec("wget $url -O $folder$file");
        if (!is_file($folder . $file) || !filesize("$folder$file")) {
            return null;
        }

        return $folder . $file;
    }

    /**
     * @param bool $force
     * @return Site
     */
    protected function getSiteCorporate($force = false)
    {
        static $siteCorporate = null;

        if (!$siteCorporate || $force) {
            $siteCorporate = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:Site')
                ->findOneBy(['slug' => 'site-institutionnel'])
            ;
        }

        return $siteCorporate;
    }

    /**
     * @param bool $force
     * @return Site
     */
    protected function getSiteEvent($force = true)
    {
        static $siteEvent = null;

        if (!$siteEvent || $force) {
            $siteEvent = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:Site')
                ->findOneBy(['slug' => 'site-evenementiel'])
            ;
        }

        return $siteEvent;
    }

    /**
     * @param OldArticle $oldArticle
     * @return FilmFestival
     */
    protected function getFestival(OldArticle $oldArticle)
    {
        $date = $oldArticle->getStartDate() ?: $oldArticle->getUpdatedAt();
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmFestival')
            ->findOneBy(['year' => $date->format('Y')])
            ;
    }


    /**
     * @param OldArticleI18n[] $oldArticleTranslations
     * @return bool
     */
    protected function hasFrenchTranslation($oldArticleTranslations)
    {
        foreach ($oldArticleTranslations as $trans) {
            if ($trans->getCulture() == 'fr') {
                return true;
            }
        }
        return false;
    }

    /**
     * @param bool $force
     * @return $this
     */
    public function getDefaultTheme($force = false)
    {
        if (!$this->defaultTheme || $force) {
            $this->defaultTheme = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:Theme')
                ->find($this->defaultThemeId)
            ;
        }

        return $this->defaultTheme;
    }

    public function setDefaultThemeId($id)
    {
        $this->defaultThemeId = $id;
    }

    /**
     * @param OldMedia $oldMedia
     * @param $locale
     * @return int
     */
    protected function getStatusMedia(OldMedia $oldMedia, $locale)
    {
        if ($oldMedia->getIsOnline() && 'fr' == $locale) {
            return TranslateChildInterface::STATUS_PUBLISHED;
        } elseif ($oldMedia->getIsOnline()) {
            return TranslateChildInterface::STATUS_TRANSLATED;
        } else {
            return TranslateChildInterface::STATUS_DEACTIVATED;
        }
    }

    /**
     * @param int $oldMediaId
     * @param string $locale
     * @param int|null $status
     * @param boolean $setCorporate
     * @return MediaImage
     */
    protected function createMediaImageFromOldMedia($oldMediaId, $locale, $status = null, $setCorporate = true)
    {
        $imgTitle = [
            'fr' => 'photo',
            'en' => 'photo',
            'es' => 'foto',
            'zh' => '照片',
        ];

        $oldLocale = $locale == 'zh' ? 'cn' : $locale;

        $oldMedia = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->findOneBy(['id' => $oldMediaId])
        ;

        $oldMediaI18n = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMediaI18n')
            ->findOneBy(['culture' => $oldLocale, 'id' => $oldMediaId])
        ;

        if (!$oldMedia || !$oldMediaI18n) {
            return null;
        }

        $oldUrl = 'http://www.festival-cannes.fr/assets/Image/General/';
        $file = $this->createImage($oldUrl . trim($oldMedia->getFilename()));

        if (!$file) {
            return null;
        }

        $mediaImage = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaImage')
            ->findOneBy(['oldMediaId' => $oldMedia->getId()])
        ;

        if (!$mediaImage) {
            $mediaImage = new MediaImage();
            $mediaImage->setOldMediaId($oldMedia->getId());
            $this->getManager()->persist($mediaImage);
        }

        $mediaImage
            ->setTheme($this->defaultTheme)
            ->setDisplayedAll(true)
            ->setPublishedAt($oldMedia->getPublishFor())
            ->setCreatedAt($oldMedia->getCreatedAt())
            ->setUpdatedAt($oldMedia->getUpdatedAt())
        ;

        if ($setCorporate) {
            if (!$mediaImage->getSites()->contains($this->getSiteCorporate())) {
                $mediaImage->addSite($this->getSiteCorporate());
            }
        }

        $mediaImageTranslation = $mediaImage->findTranslationByLocale($locale);

        if (!$mediaImageTranslation) {
            $mediaImageTranslation = new MediaImageTranslation();
            $mediaImageTranslation
                ->setLocale($locale)
                ->setTranslatable($mediaImage)
            ;
            $this->getManager()->persist($mediaImageTranslation);
        }


        $mediaImageTranslation
            ->setLegend($oldMediaI18n->getLabel() ?: $imgTitle[$locale])
            ->setCopyright($oldMediaI18n->getCopyright())
            ->setIsPublishedOnFDCEvent(true)
        ;

        if ($status) {
            $mediaImageTranslation->setStatus($status);
        } else {
            $mediaImageTranslation->setStatus($this->getStatusMedia($oldMedia, $locale));
        }

        $media = $mediaImageTranslation->getFile();
        if (!$media || $this->input->getOption('force-reupload')) {
            $media = new Media();
            $media->setName($oldMedia->getFilename());
            $media->setEnabled(true);
            $media->setBinaryContent($file);
            $media->setProviderReference($oldMedia->getFilename());
            $media->setContext('media_image');
            $media->setProviderStatus(1);
            $media->setProviderName('sonata.media.provider.image');
            $media->setCreatedAt($oldMedia->getCreatedAt());
            $this->getMediaManager()->save($media, false);

            $mediaImageTranslation->setFile($media);
        }

        $this->getManager()->flush();

        return $mediaImage;
    }

    /**
     * @param int $oldMediaId
     * @param string $locale
     * @param int|null $status
     * @param boolean $setCorporate
     * @return MediaAudio
     */
    protected function createMediaAudioFromOldMedia($oldMediaId, $locale, $status = null, $setCorporate = true)
    {
        $audioTitle = [
            'fr' => 'audio',
            'en' => 'audio',
            'es' => 'audio',
            'zh' => '音频',
        ];

        $oldMedia = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->findOneBy(['id' => $oldMediaId])
        ;

        if (!$oldMedia) {
            return null;
        }

        $oldMediasI18n = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMediaI18n')
            ->findBy(['id' => $oldMediaId])
        ;

        if (!$oldMediasI18n) {
            return null;
        }

        $mediaAudio = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaAudio')
            ->findOneBy(['oldMediaId' => $oldMedia->getId()])
        ;

        if (!$mediaAudio) {
            $mediaAudio = new MediaAudio();
            $mediaAudio->setOldMediaId($oldMedia->getId());
            $this->getManager()->persist($mediaAudio);
        }

        $mediaAudio
            ->setTheme($this->defaultTheme)
            ->setDisplayedAll(true)
            ->setPublishedAt($oldMedia->getPublishFor())
            ->setCreatedAt($oldMedia->getCreatedAt())
            ->setUpdatedAt($oldMedia->getUpdatedAt())
        ;

        foreach ($oldMediasI18n as $oldMediaI18n) {
            $locale = $oldMediaI18n->getCulture() == 'cn' ? 'zh' : $oldMediaI18n->getCulture();
            if (!in_array($locale, $this->langs)) {
                continue;
            }

            $mediaAudioTranslation = $mediaAudio->findTranslationByLocale($locale);

            if ($mediaAudioTranslation) {
                continue;
            }

            $code = $oldMediaI18n->getCode();
            if (!$code) {
                $duplicate = $this->getManager()->getRepository('BaseCoreBundle:OldMediaI18n')->findOneBy([
                    'id'      => $oldMedia->getId(),
                    'culture' => 'bi',
                ])
                ;
                if ($duplicate && $duplicate->getCode()) {
                    $code = $duplicate->getCode();
                    $audioPath = 'http://www.festival-cannes.fr/mp3/' . trim($code) . '.mp3';
                }
                if ($duplicate && !$duplicate->getCode() && $oldMediaI18n->getHdFormatFilename()) {
                    $code = $oldMediaI18n->getCode();
                    $audioPath = 'http://www.festival-cannes.fr/' . trim($code);
                }
                if (!$code) {
                    continue;
                }
            } else {
                $audioPath = 'http://www.festival-cannes.fr/mp3/' . trim($code) . '.mp3';
            }

            $file = $this->createAudio($audioPath);

            if (!$file) {
                continue;
            }

            if ($oldMediaI18n->getFilenameThumbnail()) {
                $mediaAudio->setImage($this->getMediaImageThumbnail($oldMedia, $oldMediaI18n, 'audio', $locale));
            }

            if ($setCorporate) {
                if (!$mediaAudio->getSites()->contains($this->getSiteCorporate())) {
                    $mediaAudio->addSite($this->getSiteCorporate());
                }
            }

            $mediaAudioTranslation = new MediaAudioTranslation();
            $mediaAudioTranslation
                ->setLocale($locale)
                ->setTranslatable($mediaAudio)
            ;
            $this->getManager()->persist($oldMediaI18n);
            $mediaAudioTranslation
                ->setTitle($oldMediaI18n->getLabel() ?: $audioTitle[$locale])
                ->setJobMp3Id(MediaAudioTranslation::ENCODING_STATE_READY)
            ;

            if ($status) {
                $mediaAudioTranslation->setStatus($status);
            } else {
                $mediaAudioTranslation->setStatus($this->getStatusMedia($oldMedia, $locale));
            }

            $media = $mediaAudioTranslation->getFile();
            if (!$media) {
                $media = new Media();
                $media->setName($mediaAudioTranslation->getTitle());
                $media->setBinaryContent($file);
                $media->setEnabled(true);
                $media->setProviderReference($mediaAudioTranslation->getTitle());
                $media->setContext('media_audio');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.audio');
                $this->getMediaManager()->save($media);
                $mediaAudioTranslation->setFile($media);
            }
            $this->setMediaAudioFilmFilmAssociations($mediaAudio);
        }

        $this->getManager()->flush();
        return $mediaAudio;
    }

    /**
     * @param int $oldMediaId
     * @param string $locale
     * @param int|null $status
     * @param boolean $setCorporate
     * @return MediaVideo
     */
    protected function createMediaVideoFromOldMedia($oldMediaId, $locale, $status = null, $setCorporate = true)
    {
        $videoTitle = [
            'fr' => 'video',
            'en' => 'video',
            'es' => 'video',
            'zh' => '视频',
        ];

        $oldLocale = $locale == 'zh' ? 'cn' : $locale;

        $oldMedia = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMedia')
            ->findOneBy(['id' => $oldMediaId])
        ;

        $oldMediaI18n = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMediaI18n')
            ->findOneBy(['culture' => $oldLocale, 'id' => $oldMediaId])
        ;

        if (!$oldMedia || !$oldMediaI18n) {
            return null;
        }

        $path = $oldMediaI18n->getDeliveryUrl();
        $pathArray = explode(',', $path);
        $path = $pathArray[0] . '80' . $pathArray[count($pathArray) - 1];
        $file = $this->createVideo('http://canneshd-a.akamaihd.net/' . trim($path));

        if (!$file) {
            return null;
        }

        $mediaVideo = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->findOneBy(['oldMediaId' => $oldMedia->getId()])
        ;

        if (!$mediaVideo) {
            $mediaVideo = new MediaVideo();
            $mediaVideo->setOldMediaId($oldMedia->getId());
            $this->getManager()->persist($mediaVideo);
        }

        $mediaVideo
            ->setDisplayedHomeCorpo(false)
            ->setTheme($this->defaultTheme)
            ->setDisplayedAll(true)
            ->setPublishedAt($oldMedia->getPublishFor())
            ->setCreatedAt($oldMedia->getCreatedAt())
            ->setUpdatedAt($oldMedia->getUpdatedAt())
        ;

        if ($oldMediaI18n->getFilenameThumbnail()) {
            $mediaVideo->setImage($this->getMediaImageThumbnail($oldMedia, $oldMediaI18n, 'video', $locale));
        }

        if ($setCorporate) {
            if (!$mediaVideo->getSites()->contains($this->getSiteCorporate())) {
                $mediaVideo->addSite($this->getSiteCorporate());
            }
        }

        $mediaVideoTranslation = $mediaVideo->findTranslationByLocale($locale);

        if (!$mediaVideoTranslation) {
            $mediaVideoTranslation = new MediaVideoTranslation();
            $mediaVideoTranslation
                ->setLocale($locale)
                ->setTranslatable($mediaVideo)
            ;
            $this->getManager()->persist($oldMediaI18n);
        }

        $mediaVideoTranslation
            ->setTitle($oldMediaI18n->getLabel() ?: $videoTitle[$locale])
            ->setJobMp4State(MediaVideoTranslation::ENCODING_STATE_READY)
            ->setJobWebmState(MediaVideoTranslation::ENCODING_STATE_READY)
        ;

        if ($status) {
            $mediaVideoTranslation->setStatus($status);
        } else {
            $mediaVideoTranslation->setStatus($this->getStatusMedia($oldMedia, $locale));
        }

        $media = $mediaVideoTranslation->getFile();
        if (!$media) {
            $media = new Media();
            $media->setName($oldMediaI18n->getLabel());
            $media->setBinaryContent($file);
            $media->setEnabled(true);
            $media->setProviderReference($oldMediaI18n->getLabel());
            $media->setContext('media_video');
            $media->setProviderStatus(1);
            $media->setProviderName('sonata.media.provider.video');
            if ($media->getId() == null) {
                $this->getMediaManager()->save($media);
            }
            $mediaVideoTranslation->setFile($media);

            $this->getManager()->persist($media);
            $mediaVideoTranslation->setFile($media);

        }
        $this->setMediaVideoFilmFilmAssociations($mediaVideo);
        $this->getManager()->flush();
        unlink($file);
        return $mediaVideo;
    }

    private function getMediaImageThumbnail(OldMedia $oldMedia, OldMediaI18n $oldMediaI18n, $mediaType = 'audio', $locale)
    {
        $folders = [
            'audio' => 'http://www.festival-cannes.fr/assets/Audio/General/thumbnails/',
            'video' => 'http://www.festival-cannes.fr/assets/Video/General/thumbnails/',
        ];

        $thumbPath = $folders[$mediaType] . $oldMediaI18n->getFilenameThumbnail();
        $fileThumb = $this->createImage($thumbPath);
        if ($fileThumb) {
            $oldReference = 'audio-thumb-' . $oldMediaI18n->getId();
            $mediaImage = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:MediaImage')
                ->findOneBy(['oldReference' => $oldReference])
            ;

            if (!$mediaImage) {
                if (!$mediaImage) {
                    $mediaImage = new MediaImage();
                    $mediaImage->setOldReference($oldReference);
                    $this->getManager()->persist($mediaImage);
                }

                $mediaImage
                    ->setTheme($this->defaultTheme)
                    ->setDisplayedAll(false)
                    ->setPublishedAt($oldMedia->getPublishFor())
                    ->setCreatedAt($oldMedia->getCreatedAt())
                    ->setUpdatedAt($oldMedia->getUpdatedAt())
                ;
            }

            $mediaImageTranslation = $mediaImage->findTranslationByLocale($locale);
            if (!$mediaImageTranslation) {
                $mediaImageTranslation = new MediaImageTranslation();
                $mediaImageTranslation
                    ->setLocale($locale)
                    ->setTranslatable($mediaImage)
                ;
                $this->getManager()->persist($mediaImageTranslation);
            }

            $media = $mediaImageTranslation->getFile();

            if (!$media) {
                $media = new Media();
                $media->setName($oldMedia->getFilename());
                $media->setBinaryContent($fileThumb);
                $media->setEnabled(true);
                $media->setProviderReference($oldMedia->getFilename());
                $media->setContext('media_image');
                $media->setProviderStatus(1);
                $media->setProviderName('sonata.media.provider.image');
                $media->setCreatedAt($oldMedia->getCreatedAt());
            }
            $media->setThumbsGenerated(false);
            $media->setBinaryContent($fileThumb);
            $this->getMediaManager()->save($media, false);
            $mediaImageTranslation->setFile($media);
            return $mediaImage;
        }
    }

    private function setMediaAudioFilmFilmAssociations(MediaAudio $mediaAudio)
    {
        $oldMediaAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMediaAssociation')
            ->findBy(['id' => $mediaAudio->getOldMediaId()], ['order' => 'asc'])
        ;
        $excludeFromRemove = [];
        foreach ($oldMediaAssociations as $oldMediaAssociation) {
            $filmFilm = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($oldMediaAssociation->getObjectId())
            ;

            if ($filmFilm) {
                $excludeFromRemove[] = $filmFilm->getId();
                $mediaAudioFilmFilmAssociated = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaAudioFilmFilmAssociated')
                    ->findOneBy(['mediaAudio' => $mediaAudio->getId(), 'association' => $filmFilm->getId()])
                ;

                if (!$mediaAudioFilmFilmAssociated) {
                    $mediaAudioFilmFilmAssociated = new MediaAudioFilmFilmAssociated();
                    $mediaAudioFilmFilmAssociated
                        ->setAssociation($filmFilm);
                    $this->getManager()->persist($mediaAudioFilmFilmAssociated);
                    $mediaAudio->addAssociatedFilm($mediaAudioFilmFilmAssociated);

                }
            }
        }

        foreach ($mediaAudio->getAssociatedFilms() as $mediaAudioFilmFilmAssociated) {
            if ($mediaAudioFilmFilmAssociated instanceof MediaAudioFilmFilmAssociated) {
                if (!in_array($mediaAudioFilmFilmAssociated->getAssociation()->getId(), $excludeFromRemove)) {
                    $mediaAudio->removeAssociatedFilm($mediaAudioFilmFilmAssociated);
                    $this->getManager()->remove($mediaAudioFilmFilmAssociated);
                }
            }
        }
    }

    private function setMediaVideoFilmFilmAssociations(MediaVideo $mediaVideo)
    {
        $oldMediaAssociations = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldMediaAssociation')
            ->findBy(['id' => $mediaVideo->getOldMediaId()], ['order' => 'asc'])
        ;
        $excludeFromRemove = [];
        foreach ($oldMediaAssociations as $oldMediaAssociation) {
            $filmFilm = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($oldMediaAssociation->getObjectId())
            ;

            if ($filmFilm) {
                $excludeFromRemove[] = $filmFilm->getId();
                $mediaVideoFilmFilmAssociated = $this
                    ->getManager()
                    ->getRepository('BaseCoreBundle:MediaVideoFilmFilmAssociated')
                    ->findOneBy(['mediaVideo' => $mediaVideo->getId(), 'association' => $filmFilm->getId()])
                ;

                if (!$mediaVideoFilmFilmAssociated) {
                    $mediaVideoFilmFilmAssociated = new MediaVideoFilmFilmAssociated();
                    $mediaVideoFilmFilmAssociated
                        ->setAssociation($filmFilm);
                    $this->getManager()->persist($mediaVideoFilmFilmAssociated);
                    $mediaVideo->addAssociatedFilm($mediaVideoFilmFilmAssociated);

                }
            }
        }

        foreach ($mediaVideo->getAssociatedFilms() as $mediaVideoFilmFilmAssociated) {
            if ($mediaVideoFilmFilmAssociated instanceof MediaVideoFilmFilmAssociated) {
                if (!in_array($mediaVideoFilmFilmAssociated->getAssociation()->getId(), $excludeFromRemove)) {
                    $mediaVideo->removeAssociatedFilm($mediaVideoFilmFilmAssociated);
                    $this->getManager()->remove($mediaVideoFilmFilmAssociated);
                }
            }
        }
    }

}
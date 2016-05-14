<?php

namespace Base\AdminBundle\Command;


use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExcludeFromSearchCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('admin:exclude-from-search')
            ->setDescription('Exclude from search')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->excludeMediaVideos($output);
        $this->excludeMediaAudios($output);
        $this->excludeMediaImages($output);
        $this->publishMediaImages($output);
    }

    protected function excludeMediaVideos(OutputInterface $output)
    {
        $qb = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaVideoTranslation')
            ->createQueryBuilder('mvt')
        ;
        if ($qb instanceof QueryBuilder) {
            $qb
                ->andWhere('mvt.title LIKE :search')
                ->setParameter('search', '%loop%')
            ;
        }
        $flush = false;
        $videoTranslations = $qb->getQuery()->getResult();
        $ids = array();
        foreach ($videoTranslations as $videoTranslation) {
            if ($videoTranslation instanceof MediaVideoTranslation) {
                $video = $videoTranslation->getTranslatable();
                if ($video instanceof MediaVideo && !in_array($video->getId(), $ids)) {
                    $ids[] = $video->getId();
                    $video->setExcludeFromSearch(true);
                    $flush = true;
                    $this->getDoctrineManager()->persist($video);
                }
            }
        }
        if ($flush) {
            $this->getDoctrineManager()->flush();
            $this->getDoctrineManager()->clear();
            $output->writeln(count($ids) . ' videos have been excluded from search.');
        }
    }

    protected function excludeMediaAudios(OutputInterface $output)
    {
        $qb = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaAudioTranslation')
            ->createQueryBuilder('mat')
        ;
        if ($qb instanceof QueryBuilder) {
            $qb
                ->andWhere('mat.title LIKE :search')
                ->setParameter('search', '%loop%')
            ;
        }
        $flush = false;
        $audioTranslations = $qb->getQuery()->getResult();
        $ids = array();
        foreach ($audioTranslations as $audioTranslation) {
        if ($audioTranslation instanceof MediaAudioTranslation) {
                $audio = $audioTranslation->getTranslatable();
                if ($audio instanceof MediaAudio && !in_array($audio->getId(), $ids)) {
                    $ids[] = $audio->getId();
                    $audio->setExcludeFromSearch(true);
                    $flush = true;
                    $this->getDoctrineManager()->persist($audio);
                }
            }
        }
        if ($flush) {
            $this->getDoctrineManager()->flush();
            $this->getDoctrineManager()->clear();
            $output->writeln(count($ids) . ' audios have been excluded from search.');
        }
        
    }

    protected function excludeMediaImages(OutputInterface $output)
    {
        $qb = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaImageTranslation')
            ->createQueryBuilder('mit')
        ;
        if ($qb instanceof QueryBuilder) {
            $qb
                ->andWhere('mit.legend LIKE :search OR mit.legend LIKE :slice OR mit.legend LIKE :trailer')
                ->setParameter('search', '%loop%')
                ->setParameter('slice', '%extrait%')
                ->setParameter('trailer', '%loop%')
            ;
        }
        $flush = false;
        $imageTranslations = $qb->getQuery()->getResult();
        $ids = array();
        foreach ($imageTranslations as $imageTranslation) {
        if ($imageTranslation instanceof MediaImageTranslation) {
                $image = $imageTranslation->getTranslatable();
                if ($image instanceof MediaImage && !in_array($image->getId(), $ids)) {
                    $ids[] = $image->getId();
                    $image->setExcludeFromSearch(true);
                    $flush = true;
                    $this->getDoctrineManager()->persist($image);
                }
            }
        }
        if ($flush) {
            $this->getDoctrineManager()->flush();
            $this->getDoctrineManager()->clear();

            if ($flush) {
                $this->getDoctrineManager()->flush();
                $this->getDoctrineManager()->clear();
                $output->writeln(count($ids) . ' images have been excluded from search.');
            }
        }
    }

    protected function publishMediaImages(OutputInterface $output)
    {
        $qb = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:MediaImageTranslation')
            ->createQueryBuilder('mit')
        ;
        if ($qb instanceof QueryBuilder) {
            $qb
                ->andWhere('mit.legend LIKE :slice OR mit.legend LIKE :trailer')
                ->setParameter('slice', '%extrait%')
                ->setParameter('trailer', '%loop%')
            ;
        }
        $siteFdcEvent = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(array('slug' => 'site-evenementiel'));


        $flush = false;
        $imageTranslations = $qb->getQuery()->getResult();
        $ids = array();
        foreach ($imageTranslations as $imageTranslation) {
        if ($imageTranslation instanceof MediaImageTranslation) {
                $image = $imageTranslation->getTranslatable();
                if ($image instanceof MediaImage && !in_array($image->getId(), $ids)) {
                    $ids[] = $image->getId();
                    if (!$image->getSites()->contains($siteFdcEvent)) {
                        $image->addSite($siteFdcEvent);
                    }
                    $image->setDisplayedMobile(true);
                    $this->getDoctrineManager()->persist($image);
                    foreach ($image->getTranslations() as $translation) {
                        if ($translation instanceof MediaImageTranslation) {
                            $translation->setisPublishedOnFDCEvent(true);
                            if ($translation->getLocale() == 'fr') {
                                $translation->setStatus(TranslateChildInterface::STATUS_PUBLISHED);
                            }
                            else {
                                $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATED);
                            }
                            $this->getDoctrineManager()->persist($translation);
                        }
                    }
                }
            }
        }
        if ($flush) {
            $this->getDoctrineManager()->flush();
            $this->getDoctrineManager()->clear();

            if ($flush) {
                $this->getDoctrineManager()->flush();
                $this->getDoctrineManager()->clear();
                $output->writeln(count($ids) . ' images and its have been published on FDC Event and Mobile.');
            }
        }
    }

    /**
     * @return ObjectManager
     */
    public function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}
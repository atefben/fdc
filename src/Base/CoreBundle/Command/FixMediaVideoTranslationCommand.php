<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\OldMediaI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixMediaVideoTranslationCommand extends ContainerAwareCommand
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var InputInterface
     */
    private $input;

    private $locales = ['en', 'es', 'zh'];

    protected function configure()
    {
        $this
            ->setName('base:core:fix-video-translation')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'media-video-id')
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, null)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $id = $input->getOption('id');
        $offset = $input->getOption('offset');
        $limit = $input->getOption('limit');

        if ($id) {
            $mediaVideo = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideo')
                ->find($id)
            ;
            if ($mediaVideo instanceof MediaVideo) {
                $this->createMissingTranslations($mediaVideo);
            }
            $output->writeln("<info>Video $id has been checked</info>");
        } else {
            $mediaVideos = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaVideo')
                ->createQueryBuilder('m')
                ->andWhere('m.oldMediaId is not null')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
            ;

            if ($mediaVideos) {
                $progress = new ProgressBar($output, count($mediaVideos));
                $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
                $progress->start();
                foreach ($mediaVideos as $mediaVideo) {
                    $progress->advance();
                    if ($mediaVideo instanceof MediaVideo) {
                        $this->createMissingTranslations($mediaVideo);
                    }
                }

                $progress->finish();
                $output->writeln('<info>Done</info>');
            } else {
                $output->writeln('<info>Videos not found</info>');
            }

        }
    }

    private function createMissingTranslations(MediaVideo $mediaVideo)
    {
        $master = $mediaVideo->findTranslationByLocale('fr');
        if (!($master instanceof MediaVideoTranslation)) {
            return;
        }

        foreach ($this->locales as $locale) {
            $translation = $mediaVideo->findTranslationByLocale($locale);
            if (!($translation instanceof MediaVideoTranslation)) {
                $translation = new MediaVideoTranslation();

                if ($master->getStatus() === TranslateChildInterface::STATUS_PUBLISHED) {
                    $status = TranslateChildInterface::STATUS_TRANSLATED;
                } else {
                    $status = TranslateChildInterface::STATUS_DRAFT;
                }
                $translation
                    ->setMp4Url($master->getMp4Url())
                    ->setWebmURL($master->getWebmURL())
                    ->setJobMp4State($master->getJobMp4State())
                    ->setJobWebmState($master->getJobWebmState())
                    ->setJobMp4Id($master->getJobMp4Id())
                    ->setJobWebmId($master->getJobWebmId())
                    ->setImageAmazonUrl($master->getImageAmazonUrl())
                    ->setStatus($status)
                    ->setTranslatable($master->getTranslatable())
                    ->setLocale($locale)
                    ->setCreatedAt($master->getCreatedAt())
                    ->setUpdatedAt($master->getUpdatedAt())
                ;

                $this->getDoctrineManager()->persist($translation);
            }
            $oldMediaI18n = $this->getOldMediai18n($mediaVideo->getOldMediaId(), $locale);
            if ($oldMediaI18n && $oldMediaI18n->getLabel()) {
                $translation->setTitle($oldMediaI18n->getLabel());
            } else {
                $translation->setTitle($master->getTitle());
            }
            $this->getDoctrineManager()->flush();
        }
    }

    /**
     * @param $id
     * @param $locale
     * @return OldMediaI18n
     */
    private function getOldMediai18n($id, $locale)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:OldMediaI18n')
            ->findOneBy([
                'id'      => $id,
                'culture' => $locale == 'zh' ? 'cn' : $locale,
            ])
            ;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
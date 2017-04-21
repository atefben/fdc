<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\OldMediaI18n;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixMediaAudioTranslationCommand extends ContainerAwareCommand
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
            ->setName('base:core:fix-audio-translation')
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
            $MediaAudio = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaAudio')
                ->find($id)
            ;
            if ($MediaAudio instanceof MediaAudio) {
                $this->createMissingTranslations($MediaAudio);
            }
            $output->writeln("<info>Video $id has been checked</info>");
        } else {
            $MediaAudios = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:MediaAudio')
                ->createQueryBuilder('m')
                ->andWhere('m.oldMediaId is not null')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
            ;

            if ($MediaAudios) {
                $progress = new ProgressBar($output, count($MediaAudios));
                $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
                $progress->start();
                foreach ($MediaAudios as $MediaAudio) {
                    $progress->advance();
                    if ($MediaAudio instanceof MediaAudio) {
                        $this->createMissingTranslations($MediaAudio);
                    }
                }

                $progress->finish();
                $output->writeln('<info>Done</info>');
            } else {
                $output->writeln('<info>Videos not found</info>');
            }

        }
    }

    private function createMissingTranslations(MediaAudio $MediaAudio)
    {
        $master = $MediaAudio->findTranslationByLocale('fr');
        if (!($master instanceof MediaAudioTranslation)) {
            $masterEn = $MediaAudio->findTranslationByLocale('en');
            if (!($masterEn instanceof MediaAudioTranslation)) {
                return;
            }
            if ($masterEn->getStatus() === TranslateChildInterface::STATUS_TRANSLATED) {
                $status = TranslateChildInterface::STATUS_PUBLISHED;
            } else {
                $status = TranslateChildInterface::STATUS_DRAFT;
            }
            $master = new MediaAudioTranslation();
            $master
                ->setMp3Url($masterEn->getMp3Url())
                ->setJobMp3State($masterEn->getJobMp3State())
                ->setJobMp3Id($masterEn->getJobMp3Id())
                ->setStatus($status)
                ->setTranslatable($masterEn->getTranslatable())
                ->setLocale('fr')
                ->setCreatedAt($masterEn->getCreatedAt())
                ->setUpdatedAt($masterEn->getUpdatedAt())
                ->setTitle($masterEn->getTitle())
            ;
            $this->getDoctrineManager()->persist($master);
            $this->getDoctrineManager()->flush();

        }

        foreach ($this->locales as $locale) {
            $translation = $MediaAudio->findTranslationByLocale($locale);
            if (!($translation instanceof MediaAudioTranslation)) {
                $translation = new MediaAudioTranslation();
                if ($master->getStatus() === TranslateChildInterface::STATUS_PUBLISHED) {
                    $status = TranslateChildInterface::STATUS_TRANSLATED;
                } else {
                    $status = TranslateChildInterface::STATUS_DRAFT;
                }
                $translation
                    ->setMp3Url($master->getMp3Url())
                    ->setJobMp3State($master->getJobMp3State())
                    ->setJobMp3Id($master->getJobMp3Id())
                    ->setStatus($status)
                    ->setTranslatable($master->getTranslatable())
                    ->setLocale($locale)
                    ->setCreatedAt($master->getCreatedAt())
                    ->setUpdatedAt($master->getUpdatedAt())
                ;

                $this->getDoctrineManager()->persist($translation);
            }
            $oldMediaI18n = $this->getOldMediai18n($MediaAudio->getOldMediaId(), $locale);
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
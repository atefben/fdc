<?php

namespace Base\CoreBundle\Command;


use Base\CoreBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MediaSiteCommand extends ContainerAwareCommand
{
    private $entities = [
        'MediaImage' => MediaImage::class,
        'MediaAudio' => MediaAudio::class,
        'MediaVideo' => MediaVideo::class,

    ];
    protected function configure()
    {
        $this
            ->setName('base:core:media-site')
            ->addArgument('entity', InputArgument::REQUIRED, 'MediaImage, MediaAudio, MediaVideo')
            ->addOption('begin', null, InputOption::VALUE_REQUIRED, 'Min id')
            ->addOption('end', null, InputOption::VALUE_REQUIRED, 'Max Id')
            ->addOption('site', null, InputOption::VALUE_REQUIRED, 'The site slug')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getArgument('entity');
        $begin = $input->getOption('begin');
        $end = $input->getOption('end');
        $siteSlug = $input->getOption('site');

        $site = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(['slug' => $siteSlug])
        ;

        if (!$site) {
            throw new \Exception("$entity is not an available site");
        }

        if (!array_key_exists($entity, $this->entities)) {
            throw new \Exception("$entity is not an available entity");
        }

        $medias = $this
            ->getDoctrineManager()
            ->getRepository($this->entities[$entity])
            ->createQueryBuilder('m')
            ->andWhere('m.id BETWEEN :begin AND :end')
            ->setParameter(':begin', $begin)
            ->setParameter(':end', $end)
            ->getQuery()
            ->getResult()
        ;

        if ($medias) {
            $progress = new ProgressBar($output, count($medias));
            $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
            $progress->start();

            foreach ($medias as $media) {
                $progress->advance();
                if ($media instanceof Media) {
                    if (!$media->getSites()->contains($site)) {
                        $media->addSite($site);
                        $this->getDoctrineManager()->flush();
                    }
                }
            }
            $progress->finish();
            $output->writeln('');
        }

    }

    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
<?php

namespace Base\CoreBundle\Command;


use Base\CoreBundle\Entity\Media;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\Site;
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
            ->addOption('festival', null, InputOption::VALUE_OPTIONAL, 'Min id')
            ->addOption('begin', null, InputOption::VALUE_OPTIONAL, 'Min id')
            ->addOption('end', null, InputOption::VALUE_OPTIONAL, 'Max Id')
            ->addOption('site', null, InputOption::VALUE_REQUIRED, 'The site slug')
            ->addOption('site', null, InputOption::VALUE_REQUIRED, 'The site slug')
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, '', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getArgument('entity');
        $festival = $input->getOption('festival');
        $begin = $input->getOption('begin');
        $end = $input->getOption('end');
        $siteSlug = $input->getOption('site');
        $limit = $input->getOption('limit');
        $offset = $input->getOption('offset');

        if ((!$begin || !$end) && !$festival) {
            throw new \Exception("Please check the options");
        }

        $site = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(['slug' => $siteSlug])
        ;

        if (!($site instanceof Site) {
            throw new \Exception("$entity is not an available site");
        }

        if (!array_key_exists($entity, $this->entities)) {
            throw new \Exception("$entity is not an available entity");
        }

        if ($festival) {
            $medias = $this->getMediasByFestival($entity, $festival, $limit, $offset);
        }
        else {
            $medias = $this->getMediasByInterval($entity, $begin, $end, $limit, $offset);
        }

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

    private function getMediasByInterval($entity, $begin, $end, $limit, $offset)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository($this->entities[$entity])
            ->createQueryBuilder('m')
            ->andWhere('m.id BETWEEN :begin AND :end')
            ->setParameter(':begin', $begin)
            ->setParameter(':end', $end)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
    }

    private function getMediasByFestival($entity, $festival, $limit, $offset)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository($this->entities[$entity])
            ->createQueryBuilder('m')
            ->innerJoin('m.festival', 'f')
            ->andWhere('f.year = :festival')
            ->setParameter(':festival', $festival)
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
    }
}
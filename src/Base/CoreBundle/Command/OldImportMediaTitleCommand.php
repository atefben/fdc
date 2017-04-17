<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OldImportMediaTitleCommand extends ContainerAwareCommand
{


    protected function configure()
    {
        $this
            ->setName('base:import:fix-media-title')
            ->addOption('count', null, InputOption::VALUE_NONE, 'Show count object')
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, 'Offset', null)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, 'Limit', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('count')) {
            $output->writeln($this->countItems() . ' media are available');
            return;
        }

        $medias = $this
            ->getDoctrineManager()
            ->getRepository('ApplicationSonataMediaBundle:Media')
            ->createQueryBuilder('m')
            ->andWhere("m.oldMediaPhoto is not null")
            ->setMaxResults($input->getOption('limit'))
            ->setFirstResult($input->getOption('offset'))
            ->getQuery()
            ->getResult()
        ;

        if ($medias) {
            $progress = new ProgressBar($output, count($medias));
            $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
            $progress->start();

            foreach ($medias as $media) {
                $progress->advance();
                $this->syncOldTitle($media);
            }
            $progress->finish();
            $output->writeln('');
        } else {
            $output->writeln('<info>No items to update</info>');
        }
    }

    /**
     * @param Media $media
     */
    private function syncOldTitle(Media $media)
    {
        $oldFilmPhoto = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:OldFilmPhoto')
            ->find($media->getOldMediaPhoto())
        ;
        if ($oldFilmPhoto) {
            $media->setOldTitle($oldFilmPhoto->getTitre());
            $media->setOldTitleVa($oldFilmPhoto->getTitreVa());
            $this->getDoctrineManager()->flush();
        }
    }

    protected function countItems()
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('ApplicationSonataMediaBundle:Media')
            ->createQueryBuilder('m')
            ->select('count(m)')
            ->andWhere("m.oldMediaPhoto is not null")
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
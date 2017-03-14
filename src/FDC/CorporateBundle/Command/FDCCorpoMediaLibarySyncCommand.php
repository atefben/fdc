<?php

namespace FDC\CorporateBundle\Command;

use Application\Sonata\MediaBundle\Entity\Media;
use Base\CoreBundle\Entity\FilmFestivalPoster;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmPersonMedia;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;
use Doctrine\Common\Persistence\ObjectManager;
use FDC\CorporateBundle\Manager\CorpoMediaLibraryItemManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FDCCorpoMediaLibarySyncCommand extends ContainerAwareCommand
{
    protected $entities = [
        'FilmFestivalPoster' => FilmFestivalPoster::class,
        'FilmFilmMedia'      => FilmFilmMedia::class,
        'FilmPersonMedia'    => FilmPersonMedia::class,
        'MediaImage'         => MediaImage::class,
        'MediaAudio'         => MediaAudio::class,
        'MediaVideo'         => MediaVideo::class,
        'SonataMedia'         => Media::class,
    ];


    protected function configure()
    {

        $this
            ->setName('corpo:media:sync')
            ->addOption('entity', null, InputOption::VALUE_REQUIRED, 'The entity to update')
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getOption('entity');
        $id = $input->getOption('id');
        if (array_key_exists($entity, $this->entities)) {
            $class = $this->entities[$entity];
        } else {
            $output->writeln("<error>$entity is not an available entity</error>");
            return;
        }

        $criteria = [];
        if ($id) {
            $criteria['id'] = $id;
        }
        if ($entity== 'SonataMedia') {
            $objects = $this
                ->getDoctrineManager()
                ->getRepository('ApplicationSonataMediaBundle:Media')
                ->createQueryBuilder('m')
                ->innerJoin('m.selfkitFilms', 'sf')
                ->andWhere('m.oldMediaPhoto is not null')
                ->setFirstResult($input->getOption('first-result'))
                ->setMaxResults($input->getOption('max-results'))
                ->getQuery()
                ->getResult()
            ;
        }else {
            $objects = $this
                ->getDoctrineManager()
                ->getRepository($class)
                ->findBy($criteria, null, $input->getOption('max-results'), $input->getOption('first-result'))
            ;
        }


        if ($objects) {
            $progress = new ProgressBar($output, count($objects));
            $progress->start();

            foreach ($objects as $object) {
                $progress->advance();
                $this->getCorpoMediaLibraryItemManager()->sync($object);
            }

            $progress->finish();
            $output->writeln('');

        } else {
            $output->writeln('<info>There is no object to sync</info>');
        }
    }

    /**
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @return CorpoMediaLibraryItemManager
     */
    private function getCorpoMediaLibraryItemManager()
    {
        return $this->getContainer()->get('fdc_corpo.media_library_manager');
    }
}
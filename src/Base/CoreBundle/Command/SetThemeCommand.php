<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Media;
use Base\CoreBundle\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SetThemeCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:core:set-theme')
            ->addArgument('entity', InputArgument::REQUIRED)
            ->addArgument('theme', InputArgument::REQUIRED)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'media-video-id')
            ->addOption('offset', null, InputOption::VALUE_OPTIONAL, null)
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, null)
            ->addOption('count', null, InputOption::VALUE_NONE, null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getArgument('entity');
        $themeId = $input->getArgument('theme');
        $id = $input->getOption('id');
        $offset = $input->getOption('offset');
        $limit = $input->getOption('limit');
        $count = $input->getOption('count');

        $theme = $this->getTheme($themeId);
        if (!$theme) {
            throw new \Exception("Theme $themeId not found");
        }

        $contents = [];
        if (in_array($entity, ['news', 'info', 'statement'])) {
            if ($count) {
                $nb = $this->getContentCount($entity);
                $output->writeln("$nb elements of entity $entity");
            } else {
                $contents = $this->getContents($entity, $limit, $offset);
            }
        } elseif ($entity == 'media') {
            if ($count) {
                $nb = $this->getMediaCount();
                $output->writeln("$nb elements of entity $entity");
            } else {
                $contents = $this->getMedias($limit, $offset);
            }
        } else {
            throw new \Exception("Entity $entity not found");
        }

        if ($contents) {
            $progress = new ProgressBar($output, count($contents));
            $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
            $progress->start();

            foreach ($contents as $content) {
                $progress->advance();
                if (method_exists($content, 'setTheme')) {
                    $content->setTheme($theme);
                }
            }

            $progress->finish();
        }
    }

    private function getContentCount($entity)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:' . ucfirst($entity))
            ->createQueryBuilder('c')
            ->select('count(c) as total')
            ->andWhere('c.oldNewsId is not null')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    private function getContents($entity, $limit, $offset)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:' . ucfirst($entity))
            ->createQueryBuilder('c')
            ->andWhere('c.oldNewsId is not null')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    private function getMediaCount()
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->createQueryBuilder('m')
            ->select('count(m) as total')
            ->andWhere('m.oldMediaId is not null')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param $limit
     * @param $offset
     * @return Media[]
     */
    private function getMedias($limit, $offset)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Media')
            ->createQueryBuilder('m')
            ->andWhere('m.oldMediaId is not null')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $id
     * @return Theme
     */
    private function getTheme($id)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Theme')
            ->find($id)
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
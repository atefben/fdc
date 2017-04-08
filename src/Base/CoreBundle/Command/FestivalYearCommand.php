<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Event;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\Homepage;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\MediaImageSimple;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\PressHomepage;
use Base\CoreBundle\Entity\SocialGraph;
use Base\CoreBundle\Entity\SocialWall;
use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\WebTv;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FestivalYearCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:festival:define')
            ->addArgument('entity', InputArgument::REQUIRED)
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, '', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entities = [
            'News'                             => News::class,
            'Statement'                        => Statement::class,
            'Info'                             => Info::class,
            'Homepage'                         => Homepage::class,
            'PressHomepage'                    => PressHomepage::class,
            'MediaImageSimple'                 => MediaImageSimple::class,
            'Media'                            => \Base\CoreBundle\Entity\Media::class,
            'Event'                            => Event::class,
            'WebTv'                            => WebTv::class,
            'SocialWall'                       => SocialWall::class,
            'SocialGraph'                      => SocialGraph::class,
            'FDCPageLaSelectionCannesClassics' => FDCPageLaSelectionCannesClassics::class,
        ];

        $class = $entities[$input->getArgument('entity')];
        $items = $this
            ->getDoctrineManager()
            ->getRepository($class)
            ->findBy([], [], $input->getOption('max-results'), $input->getOption('first-result'))
        ;
        $progress = new ProgressBar($output, count($items));
        $progress->start();

        $now = new \DateTime();
        foreach ($items as $item) {
            $progress->advance();

            $item->setUpdatedAt($now);
            $this->getDoctrineManager()->flush();
        }

        $progress->finish();
        $output->writeln('');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this
            ->getContainer()
            ->get('doctrine')
            ->getManager()
            ;
    }
}
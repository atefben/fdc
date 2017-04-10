<?php

namespace Base\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixFestivalCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('base:fix:festival')
            ->addArgument('type', InputArgument::REQUIRED)
            ->addOption('page', null, InputOption::VALUE_OPTIONAL)
            ->addOption('count', null, InputOption::VALUE_NONE)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $page = $input->getOption('page')?:1;



        $type = ucfirst($input->getArgument('type'));

        if (in_array($type, ['MediaVideo', 'MediaAudio', 'MediaImage'])) {
            $oldField = 'oldMediaId';
        }
        else {
            $oldField = 'oldNewsId';
        }

        if ($input->getOption('count')) {
            $count = $this
                ->getManager()
                ->getRepository('BaseCoreBundle:' . ucfirst($input->getArgument('type')))
                ->createQueryBuilder('n')
                ->select('count(n)')
                ->andWhere("n.$oldField is not null")
                ->getQuery()
                ->getOneOrNullResult()
            ;
            return null;
        }

        $items = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:' . $type)
            ->createQueryBuilder('n')
            ->andWhere("n.$oldField is not null")
            ->setMaxResults(100)
            ->setFirstResult(($page -1) * 100)
            ->getQuery()
            ->getResult()
        ;


        $bar = new ProgressBar($output, count($items));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        foreach ($items as $item) {
            $bar->advance();
            $this->fixItem($item);
        }
        $bar->finish();
        $output->writeln('');
    }

    protected function fixItem($item)
    {
        if (!$item->getPublishedAt()) {
            return ;
        }
        $year = $item->getPublishedAt()->format('Y');
        if (!$item->getFestival() || $item->getFestival()->getYear() != $year) {
            $item->setFestival($this->getFestivalByYear($year));
            $this->getManager()->flush();
        }
    }

    /**
     * @param $year
     * @return \Base\CoreBundle\Entity\FilmFestival|null|object
     */
    protected function getFestivalByYear($year)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmFestival')
            ->findOneBy(['year' => $year])
            ;
    }


    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
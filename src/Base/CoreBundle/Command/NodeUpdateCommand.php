<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Component\Interfaces\NodeInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NodeUpdateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('node:update')
            ->addArgument('entity', null, InputArgument::REQUIRED)
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getArgument('entity');
        $firstResult = $input->getOption('first-result')?:null;
        $maxResults = $input->getOption('max-results')?:null;
        if ('info' === $entity) {
            $items = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Info')->findBy([], [], $maxResults, $firstResult);
        }
        elseif ('news' === $entity) {
            $items = $this->getDoctrineManager()->getRepository('BaseCoreBundle:News')->findBy([], [], $maxResults, $firstResult);
        }
        elseif ('statement' === $entity) {
            $items = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Statement')->findBy([], [], $maxResults, $firstResult);
        }


        $progress = new ProgressBar($output, count($items));
        $progress->start();

        $time = new \DateTime();
        foreach ($items as $item) {
            $progress->advance();
            $item->setUpdatedAt($time);
            try {
                $this->getDoctrineManager()->flush();
            } catch (\Exception $e) {
//                dump($item->getTheme());
                dump($e->getMessage());
                die;
            }

        }
        $progress->finish();
        $output->writeln('');
    }


    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
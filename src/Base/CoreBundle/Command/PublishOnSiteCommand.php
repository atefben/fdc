<?php

namespace Base\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishOnSiteCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:publish:on')
            ->addArgument('entity', InputArgument::REQUIRED)
            ->addArgument('site-slug', InputArgument::REQUIRED)
            ->addArgument('festival', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $class = '\\Base\\CoreBundle\\Entity\\' . $input->getArgument('entity');
        $objects = $this
            ->getDoctrineManager()
            ->getRepository($class)
            ->findBy(['festival' => $input->getArgument('festival')])
        ;

        if (!$objects) {
            throw new \Exception('no objects');
        }

        $site = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(['slug' => $input->getArgument('site-slug')])
        ;

        if (!$site) {
            throw new \Exception('site not found');
        }


        $bar = new ProgressBar($output, count($objects));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        foreach ($objects as $object) {
            $bar->advance();
            if (!$object->getSites()->contains($site)) {
                $object->addSite($site);
            }
            $this->getDoctrineManager()->flush();
        }

        $bar->finish();
        $output->writeln('');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}
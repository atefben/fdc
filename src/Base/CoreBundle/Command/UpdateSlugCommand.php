<?php

namespace Base\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class UpdateSlugCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('base:update:slug')
            ->addArgument('entity', InputArgument::REQUIRED)
            ->addOption('first-result', null, InputOption::VALUE_OPTIONAL, '', null)
            ->addOption('max-results', null, InputOption::VALUE_OPTIONAL, '', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityName = $input->getArgument('entity');
        $shortClass = 'BaseCoreBundle:' . $entityName;
        $firstResult = $input->getOption('first-result');
        $maxResults = $input->getOption('max-results');

        $objects = $this
            ->getDoctrineManager()
            ->getRepository($shortClass)
            ->createQueryBuilder('n')
            ->andWhere('n.oldNewsId is not null')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult()
        ;

        $progress = new ProgressBar($output, count($objects));
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();

        foreach ($objects as $object) {
            $progress->advance();
            if (method_exists($object, 'getTranslations')) {
                foreach ($object->getTranslations() as $translation) {
                    if (method_exists($translation, 'setSlug')) {
                        $translation->setUpdatedAt(new DateTime());
                        $title = $translation->getTitle();

                        $translation->setTitle($title . ' test');
                        $this->getDoctrineManager()->flush();

                        $translation->setTitle($title);
                        $this->getDoctrineManager()->flush();
                    }
                }
            }
        }
        $progress->finish();
        $output->writeln('');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }


    public function getSlug()
    {
        return $this->getContainer()->get('slug');
    }
}
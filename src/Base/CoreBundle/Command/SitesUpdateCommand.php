<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\UserBundle\Entity\Group;
use Base\CoreBundle\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityManager;

class SitesUpdateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:update:sites')
            ->setDescription('Update Sites')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();

        $site = $em->getRepository('BaseCoreBundle:Site')->findOneBy(array('slug' => 'site-institutionnel'));
        if ($site == null) {
            $site = new Site();
        }

        $site->setName('Site institutionnel');
        $site->setSlug('site-institutionnel');
        $site->setClassColor('blue');

        if ($site->getId() == null) {
            $em->persist($site);
        }

        $em->flush();
        $output->writeln('The sites has been updated');
    }

}
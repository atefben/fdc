<?php

namespace Base\CoreBundle\Command;

use Application\Sonata\UserBundle\Entity\Group;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityManager;

class GroupsUpdateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:update:groups')
            ->setDescription('Update Groups Roles')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'SOIF'));
        if($group != null) {
            $em->remove($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'FDC Writer'));
        if($group != null) {
            $em->remove($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Press Reporter'));
        if($group != null) {
            $em->remove($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Translator'));
        if($group != null) {
            $em->remove($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'SOIF'));
        if($group != null) {
            $em->remove($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Traducteur'));
        if($group != null) {
            $em->remove($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Super Admin'));
        if ($group == null) {
            $group = new Group('Super Admin');
        }
        $group->setRoles(array('ROLE_ADMIN', 'ROLE_SONATA_ADMIN', 'ROLE_SUPER_ADMIN'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Admin FDC'));
        if ($group == null) {
            $group = new Group('Admin FDC');
        }
        $group->setRoles(array('ROLE_ADMIN_FDC'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Journaliste'));
        if ($group == null) {
            $group = new Group('Journaliste');
        }
        $group->setRoles(array('ROLE_JOURNALIST'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Traducteur en chef'));
        if ($group == null) {
            $group = new Group('Traducteur en chef');
        }
        $group->setRoles(array('ROLE_TRANSLATOR_MASTER'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Traducteur FR'));
        if ($group == null) {
            $group = new Group('Traducteur FR');
        }
        $group->setRoles(array('ROLE_TRANSLATOR_FR'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Traducteur EN'));
        if ($group == null) {
            $group = new Group('Traducteur EN');
        }
        $group->setRoles(array('ROLE_TRANSLATOR_EN'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Traducteur CH'));
        if ($group == null) {
            $group = new Group('Traducteur CH');
        }
        $group->setRoles(array('ROLE_TRANSLATOR_ZH'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Traducteur ES'));
        if ($group == null) {
            $group = new Group('Traducteur ES');
        }
        $group->setRoles(array('ROLE_TRANSLATOR_ES'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Orange'));
        if ($group == null) {
            $group = new Group('Orange');
        }
        $group->setRoles(array('ROLE_ORANGE'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Community manager'));
        if ($group == null) {
            $group = new Group('Community manager');
        }
        $group->setRoles(array('ROLE_COMMUNITY_MANAGER'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Contributeur vidéos / audio'));
        if ($group == null) {
            $group = new Group('Contributeur vidéos / audio');
        }
        $group->setRoles(array('ROLE_CONTRIBUTOR_VIDEOS_AUDIOS'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $group = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'Contributeur photos'));
        if ($group == null) {
            $group = new Group('Contributeur photos');
        }
        $group->setRoles(array('ROLE_CONTRIBUTOR_PHOTOS'));
        if ($group->getId() == null) {
            $em->persist($group);
        }

        $em->flush();
        $output->writeln('The groups roles has been updated');
    }

}
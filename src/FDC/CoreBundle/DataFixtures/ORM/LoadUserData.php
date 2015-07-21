<?php

namespace FDC\CoreBundle\DataFixtures\ORM;

use Application\Sonata\UserBundle\Entity\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin-fdc@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        $user->addSite($this->getReference('site-fdc'));
        $user->addSite($this->getReference('site-mdf'));
        $user->addSite($this->getReference('site-cine'));
        $user->addSite($this->getReference('site-ccm'));
        $userManager->updateUser($user);
        
        $user = $userManager->createUser();
        $user->setUsername('writer');
        $user->setEmail('admin-fdc-mdf@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_WRITER'));
        $user->addSite($this->getReference('site-fdc'));
        $user->addSite($this->getReference('site-mdf'));
        $userManager->updateUser($user);
        
        $user = $userManager->createUser();
        $user->setUsername('translator');
        $user->setEmail('admin-fdc-translator@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_TRANSLATOR'));
        $user->addSite($this->getReference('site-fdc'));
        $user->addSite($this->getReference('site-mdf'));
        $userManager->updateUser($user);
    }

    public function getOrder()
    {
        return 2;
    }
}
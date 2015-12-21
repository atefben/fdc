<?php

namespace Base\CoreBundle\DataFixtures\ORM;

use Application\Sonata\UserBundle\Entity\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * LoadUserData class.
 * 
 * @extends     AbstractFixture
 * @implements  OrderedFixtureInterface
 * @implements  ContainerAwareInterface
 * @author      Antoine Mineau
 * @company     Ohwee
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * setContainer function.
     * 
     * @access public
     * @param ContainerInterface $container (default: null)
     * @return void
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * load function.
     * 
     * @access public
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('all-admin');
        $user->setEmail('admin-all@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addGroup($this->getReference('group-all-admin'));
        $user->addGroup($this->getReference('group-soif'));
        $user->addSite($this->getReference('site-fdc-event'));
        $userManager->updateUser($user);

        $user = $userManager->createUser();
        $user->setUsername('fdc-admin');
        $user->setEmail('admin-fdc@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addGroup($this->getReference('group-fdc-admin'));
        $user->addGroup($this->getReference('group-soif'));
        $user->addSite($this->getReference('site-fdc-event'));
        $userManager->updateUser($user);

        $user = $userManager->createUser();
        $user->setUsername('fdc-writer');
        $user->setEmail('fdc-writer@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addGroup($this->getReference('group-fdc-writer'));
        $user->addSite($this->getReference('site-fdc-event'));
        $userManager->updateUser($user);

        $user = $userManager->createUser();
        $user->setUsername('all-translator');
        $user->setEmail('admin-translator@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addGroup($this->getReference('group-all-translator'));
        $userManager->updateUser($user);
    }

    public function getOrder()
    {
        return 2;
    }
}
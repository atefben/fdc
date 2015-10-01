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
        $user->setUsername('admin');
        $user->setEmail('admin-Base@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        $user->addSite($this->getReference('site-Base'));
        $user->addSite($this->getReference('site-mdf'));
        $user->addSite($this->getReference('site-cine'));
        $user->addSite($this->getReference('site-ccm'));
        $userManager->updateUser($user);
        
        $user = $userManager->createUser();
        $user->setUsername('writer');
        $user->setEmail('admin-Base-mdf@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_WRITER'));
        $user->addSite($this->getReference('site-Base'));
        $user->addSite($this->getReference('site-mdf'));
        $userManager->updateUser($user);
        
        $user = $userManager->createUser();
        $user->setUsername('translator');
        $user->setEmail('admin-Base-translator@yopmail.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_TRANSLATOR'));
        $user->addSite($this->getReference('site-Base'));
        $user->addSite($this->getReference('site-mdf'));
        $userManager->updateUser($user);
    }

    public function getOrder()
    {
        return 2;
    }
}
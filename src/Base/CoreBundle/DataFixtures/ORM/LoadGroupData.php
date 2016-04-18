<?php

namespace Base\CoreBundle\DataFixtures\ORM;

use Application\Sonata\UserBundle\Entity\Group;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadGroupData class.
 *
 * @extends     AbstractFixture
 * @implements  OrderedFixtureInterface
 * @author      Antoine Mineau
 * @company     Ohwee
 */
class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $group = new Group('SOIF');
        $group->setRoles(array('ROLE_SOIF'));
        $manager->persist($group);
        $this->addReference('group-soif', $group);

        $group = new Group('Admin All');
        $group->setRoles(array('ROLE_ALL_ADMIN'));
        $manager->persist($group);
        $this->addReference('group-all-admin', $group);

        $group = new Group('Translator');
        $group->setRoles(array('ROLE_ALL_TRANSLATOR'));
        $manager->persist($group);
        $this->addReference('group-all-translator', $group);

        $group = new Group('Admin FDC');
        $group->setRoles(array('ROLE_FDC_ADMIN'));
        $manager->persist($group);
        $this->addReference('group-fdc-admin', $group);

        $group = new Group('FDC Writer');
        $group->setRoles(array('ROLE_FDC_WRITER'));
        $manager->persist($group);
        $this->addReference('group-fdc-writer', $group);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
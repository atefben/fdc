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
        $group->setRoles('ROLE_SOIF');
        $manager->persist($group);
        $this->addReference('group-soif', $group);

        $group = new Group('Admin FDC');
        $group->setRoles('ROLE_FDC_ADMIN', 'ROLE_SOIF');
        $manager->persist($group);
        $this->addReference('group-admin-fdc', $group);

        $group = new Group('Admin All');
        $group->setRoles('ROLE_ALL_ADMIN', 'ROLE_SOIF');
        $manager->persist($group);
        $this->addReference('group-admin-all', $group);

        $group = new Group('FDC Writer');
        $group->setRoles('ROLE_FDC_WRITER');
        $manager->persist($group);
        $this->addReference('group-fdc-writer', $group);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
<?php

namespace Base\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Base\CoreBundle\Entity\Homepage;


/**
 * LoadHomepageData class.
 *
 * @extends     AbstractFixture
 * @implements  OrderedFixtureInterface
 * @author      Antoine Mineau
 * @company     Ohwee
 */
class LoadHomepageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $homepage = new Homepage();
        $manager->persist($homepage);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
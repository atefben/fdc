<?php

namespace Base\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Base\CoreBundle\Entity\Settings;


/**
 * LoadSettingData class.
 *
 * @extends     AbstractFixture
 * @implements  OrderedFixtureInterface
 * @author      Antoine Mineau
 * @company     Ohwee
 */
class LoadSettingData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $settings = new Settings();
        $settings->setName('FDC year');
        $manager->persist($settings);

        $settings = new Settings();
        $settings->setName('FDC Api year');
        $manager->persist($settings);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
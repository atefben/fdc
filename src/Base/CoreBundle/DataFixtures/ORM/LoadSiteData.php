<?php

namespace Base\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Base\CoreBundle\Entity\Site;


/**
 * LoadSiteData class.
 * 
 * @extends     AbstractFixture
 * @implements  OrderedFixtureInterface
 * @author      Antoine Mineau
 * @company     Ohwee
 */
class LoadSiteData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $siteFdc = new Site();
        $siteFdc->setName('Site événementiel');
        $siteFdc->setClassColor('red-light');
        $manager->persist($siteFdc);
        $this->addReference('site-fdc-event', $siteFdc);

     /*   $siteMdf = new Site();
        $siteMdf->setName('Marché du film');
        $siteMdf->setClassColor('green-light');
        $manager->persist($siteMdf);
        $this->addReference('site-mdf', $siteMdf);


        $siteCine = new Site();
        $siteCine->setName('Cinéfondation');
        $siteCine->setClassColor('blue-light');
        $manager->persist($siteCine);
        $this->addReference('site-cine', $siteCine);


        $siteCcm = new Site();
        $siteCcm->setName('Cannes courts métrages');
        $siteCcm->setClassColor('purple-light');
        $manager->persist($siteCcm);
        $this->addReference('site-ccm', $siteCcm);*/

        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}
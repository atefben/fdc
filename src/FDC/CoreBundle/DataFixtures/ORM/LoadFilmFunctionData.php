<?php

namespace FDC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use FDC\CoreBundle\Entity\FilmFunction;
use FDC\CoreBundle\Entity\FilmFunctionTranslation;

class LoadFilmFunctionData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $filmFunction = new FilmFunction();
        $filmFunction->setId(3);
    
        $translation = new FilmFunctionTranslation();
        $translation->setLocale('fr');
        $translation->setName('Réalisateur');
        $filmFunction->addTranslation($translation);
        $manager->persist($filmFunction);
        
        $filmFunction = new FilmFunction();
        $filmFunction->setId(4);
    
        $translation = new FilmFunctionTranslation();
        $translation->setLocale('fr');
        $translation->setName('Acteur');
        $filmFunction->addTranslation($translation);
        $manager->persist($filmFunction);
        
        $manager->flush();
    }
}
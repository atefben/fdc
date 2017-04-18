<?php
/**
 * Created by PhpStorm.
 * User: abdi
 * Date: 17/04/2017
 * Time: 18:59
 */

namespace Base\CoreBundle\Command;


use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics as Classics;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsTranslation as ClassicsTrans;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetMovie as ClassicsWidgetMovie;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\Site;
use Base\CoreBundle\Entity\WidgetMovie;
use Base\CoreBundle\Entity\WidgetMovieFilmFilm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class CreateOldClassicsCommand extends ContainerAwareCommand
{

    private $subsections = [
        1 => 'Copies Restaurées',
        2 => 'Documentaires sur le cinéma',
        3 => 'World cinéma Foundation',
        4 => 'Hommages',
    ];
    private $models = [
        1 => 1,
        2 => 2,
        3 => 9,
        4 => 6,
    ];

    private $currentIdSubsection = null;
    private $currentSubsection = null;

    protected function configure()
    {
        $this->setName('base:core:create-old-classics');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->subsections as $idSubsection => $subsection) {
            $this->currentIdSubsection = $idSubsection;
            $this->currentSubsection = $subsection;
            $years = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getOldClassics($idSubsection)
            ;
            $progress = new ProgressBar($output, count($years));
            $progress->start();
            foreach ($years as $year => $films) {
                $progress->advance();
                $this->createClassics($year, $films);
            }
            $progress->finish();
            $output->writeln('');
        }

    }

    /**
     * @param $year
     * @param FilmFilm[] $films
     */
    private function createClassics($year, $films)
    {
        $festival = $this->getFestival($year);
        $model = $this->getModel();
        $classics = $this->createOrUpdateClassics($model, $festival);
        $this->createOrUpdateClassicsTranslations($classics, $model);
        $this->createOrUpdateWidgetVideo($classics, $films);
        $this->updateAcl($classics, 'base.admin.fdc_page_la_selection_cannes_classics');

    }

    private function createOrUpdateClassics(Classics $model, FilmFestival $festival)
    {
        $classics = $this
            ->getDoctrineManager()
            ->getRepository(Classics::class)
            ->findOneBy([
                'festival'     => $festival->getId(),
                'oldNewsTable' => $this->currentSubsection,
            ])
        ;
        if (!$classics) {
            $classics = new Classics();
            $classics->setOldNewsTable($this->currentSubsection);
            $this->getDoctrineManager()->persist($classics);
        }

        $classics
            ->setFestival($festival)
            ->setWeight($model->getWeight())
            ->setImage($model->getImage())
        ;

        $corpoSite = $this->getCorporateSite();
        if (!$classics->getSites()->contains($corpoSite)) {
            $classics->addSite($corpoSite);
        }

        $this->getDoctrineManager()->flush();
        return $classics;
    }

    private function createOrUpdateClassicsTranslations(Classics $classics, Classics $model)
    {
        foreach ($model->getTranslations() as $modelTrans) {
            if (!($modelTrans instanceof ClassicsTrans)) {
                continue;
            }
            $classicsTrans = $this
                ->getDoctrineManager()
                ->getRepository(ClassicsTrans::class)
                ->findOneBy([
                    'locale'       => $modelTrans->getLocale(),
                    'translatable' => $classics->getId(),

                ])
            ;

            if (!$classicsTrans) {
                $classicsTrans = new ClassicsTrans();
                $classicsTrans->setTranslatable($classics);
                $classicsTrans->setLocale($modelTrans->getLocale());
                $this->getDoctrineManager()->persist($classicsTrans);
            }

            $classicsTrans
                ->setTitleNav($modelTrans->getTitleNav())
                ->setTitle($modelTrans->getTitle())
                ->setHideTitle($modelTrans->getHideTitle())
                ->setStatus($modelTrans->getStatus())
            ;

            $this->getDoctrineManager()->flush();
        }
    }

    /**
     * @param Classics $classics
     * @param FilmFilm[] $films
     */
    private function createOrUpdateWidgetVideo(Classics $classics, $films)
    {
        $classicsWidgetMovie = $this
            ->getDoctrineManager()
            ->getRepository(ClassicsWidgetMovie::class)
            ->findOneBy([
                'FDCPageLaSelectionCannesClassics' => $classics->getId(),
            ])
        ;
        if (!$classicsWidgetMovie) {
            $classicsWidgetMovie = new ClassicsWidgetMovie();
            $classicsWidgetMovie->setPosition(1);
            $classicsWidgetMovie->setFDCPageLaSelectionCannesClassics($classics);
            $this->getDoctrineManager()->persist($classicsWidgetMovie);
        }
        $widgetMovie = $classicsWidgetMovie->getWidgetMovie();
        if (!$widgetMovie) {
            $widgetMovie = new WidgetMovie();
            $widgetMovie->setTitle($this->currentSubsection);
            $this->getDoctrineManager()->persist($widgetMovie);
            $classicsWidgetMovie->setWidgetMovie($widgetMovie);
        }

        $this->getDoctrineManager()->flush();
        $this->updateAcl($widgetMovie, 'base.admin.widget_movie');
        foreach ($films as $film) {
            $this->createOrUpdateWidgetMovieFilmFilm($widgetMovie, $film);
        }
    }

    private function createOrUpdateWidgetMovieFilmFilm(WidgetMovie $widgetMovie, FilmFilm $film)
    {
        $widgetMovieFilmFilm = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:WidgetMovieFilmFilm')
            ->findOneBy([
                'widgetMovie' => $widgetMovie->getId(),
                'film'        => $film->getId(),
            ])
        ;

        if (!$widgetMovieFilmFilm) {
            $widgetMovieFilmFilm = new WidgetMovieFilmFilm();
            $widgetMovieFilmFilm
                ->setWidgetMovie($widgetMovie)
                ->setFilm($film)
            ;
            $this->getDoctrineManager()->persist($widgetMovieFilmFilm);
            $this->getDoctrineManager()->flush();

        }
    }

    /**
     * @return Classics
     */
    private function getModel()
    {
            return $this
                ->getDoctrineManager()
                ->getRepository(Classics::class)
                ->find($this->models[$this->currentIdSubsection])
            ;
    }

    /**
     * @return Site
     */
    public function getCorporateSite()
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:Site')
            ->findOneBy(['slug' => 'site-institutionnel'])
            ;
    }

    /**
     * @param $year
     * @return FilmFestival
     */
    private function getFestival($year)
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFestival')
            ->findOneBy(['year' => $year])
            ;
    }


    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    private function updateAcl($object, $service)
    {
        $adminSecurityHandler = $this->getContainer()->get('sonata.admin.security.handler');
        $modelAdmin = $this->getContainer()->get($service);
        $securityInformation = $adminSecurityHandler->buildSecurityInformation($modelAdmin);

        $objectIdentity = ObjectIdentity::fromDomainObject($object);
        $acl = $adminSecurityHandler->getObjectAcl($objectIdentity);
        if (is_null($acl)) {
            $acl = $adminSecurityHandler->createAcl($objectIdentity);
        }
        $adminSecurityHandler->addObjectClassAces($acl, $securityInformation);
        $adminSecurityHandler->updateAcl($acl);
    }
}
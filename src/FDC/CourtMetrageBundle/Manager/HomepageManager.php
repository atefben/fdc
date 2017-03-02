<?php

namespace FDC\CourtMetrageBundle\Manager;

use Base\CoreBundle\Entity\GalleryTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Entity\News;
use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CatalogPushTranslation;
use FDC\CourtMetrageBundle\Entity\CcmNews;
use FDC\CourtMetrageBundle\Entity\CcmVideosCollection;
use FDC\CourtMetrageBundle\Entity\CcmYoutubesCollection;
use FDC\CourtMetrageBundle\Entity\CcmYoutubeTranslation;
use FDC\CourtMetrageBundle\Entity\Homepage;
use FDC\CourtMetrageBundle\Entity\HomepageActualiteTranslation;
use FDC\CourtMetrageBundle\Entity\HomepagePushTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSejourTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSliderTranslation;
use Symfony\Component\HttpFoundation\RequestStack;
use FDC\CourtMetrageBundle\Entity\HomepageTranslation;

class HomepageManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;

    }

    public function getSliders()
    {
        return $this->em
            ->getRepository(HomepageSliderTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getPushes()
    {
        return $this->em
            ->getRepository(HomepagePushTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getHomepageTranslation()
    {
        return $this
            ->em
            ->getRepository(HomepageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
    /**
     * @param $festivalId
     *
     * @return mixed
     */
    public function getFilmsByCourtYear()
    {
        $homepage = $this->getHomepageTranslation();

        if($homepage) {
            $year = $homepage->getTranslatable()->getCourtYear();

            $films = $this
                ->em
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->findBy(['productionYear' => $year]);

            return $films;
        }
    }

    public function getCatalogPushes()
    {
        return $this->em
            ->getRepository(CatalogPushTranslation::class)
            ->findCatalogsByLocaleOrderByPosition($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getCatalogImage()
    {
        $homepage = $this->getHomepageTranslation();

        if($homepage) {

            return $homepage->getTranslatable()->getCatalogImage();
        }
    }

    public function getActualite($locale = 'fr', $year = null, $themeId = null, $offset = 0, $limit = 3)
    {
        /** @var CcmNews[] $actualite */
        $actualites = $this->em->getRepository(CcmNews::class)->getNewsArticlesByYearAndTheme($locale, $year, $themeId, $offset, $limit, true);

        return $actualites;
    }

    public function getSejour()
    {
        return $this->em
            ->getRepository(HomepageSejourTranslation::class)
            ->findSejourForHomepage($this->requestStack->getMasterRequest()->get('_locale')
            );
    }

    public function getSejouresFromShortFilm()
    {
        return $this->em
            ->getRepository(HomepageSejourTranslation::class)
            ->findSejourForShortFilm($this->requestStack->getMasterRequest()->get('_locale')
            );
    }

    public function getSejouresFromProsPage()
    {
        return $this->em
            ->getRepository(HomepageSejourTranslation::class)
            ->findSejourForProsPage($this->requestStack->getMasterRequest()->get('_locale')
            );
    }

    public function getPage()
    {
        return $this->em->getRepository(HomepageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                )
            );
    }

    public function getAPropos($homepage)
    {
        if ($homepage && $homepage->getTranslatable()->isAProposIsActive()) {
            $homepageTranslatable = $homepage->getTranslatable();
            $data = [];

            switch ($homepageTranslatable->getAProposType()) {
                case 'video':
                    $data = $this->getVideos($homepageTranslatable);
                    break;
                case 'image':
                    $data = $this->getImages($homepageTranslatable);
                    break;
                case 'youtube':
                    $data = $this->getYoutubes($homepageTranslatable);
                    break;
                default:
                    break;
            }

            return $data;
        }

        return null;

    }

    public function getVideos($homepage)
    {
        $videosCollection = $this->em->getRepository(CcmVideosCollection::class)
            ->findBy(
                array(
                    'homepage' => $homepage->getId(),
                ),
                array(
                    'position' => 'ASC'
                )
            );

        if ($videosCollection) {
            $videos = [];

            foreach ($videosCollection as $item) {
                $video = $this->em->getRepository(MediaVideoTranslation::class)
                    ->findOneBy(
                        array(
                            'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                            'translatable' => $item->getVideo(),
                            'status' => array(
                                MediaVideoTranslation::STATUS_PUBLISHED,
                                MediaVideoTranslation::STATUS_TRANSLATED
                            )
                        )
                    );

                if ($video) {
                    $videos[] = $video;
                }
            }

            return $videos;
        }

        return null;
    }

    public function getImages($homepage)
    {
        if ($homepage->getGallery()) {
            $gallery = $this->em->getRepository(GalleryTranslation::class)
                ->findOneBy(
                    array(
                        'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                        'translatable' => $homepage->getGallery(),
                        'status' => array(
                            GalleryTranslation::STATUS_PUBLISHED,
                            GalleryTranslation::STATUS_TRANSLATED
                        )
                    )
                );

            return $gallery;
        }

        return null;
    }

    public function getYoutubes($homepage)
    {
        $youtubesCollection = $this->em->getRepository(CcmYoutubesCollection::class)
            ->findBy(
                array(
                    'homepage' => $homepage->getId()
                ),
                array(
                    'position' => 'ASC'
                )
            );

        if ($youtubesCollection) {
            $youtubes = [];

            foreach ($youtubesCollection as $item) {
                $youtube = $this->em->getRepository(CcmYoutubeTranslation::class)
                    ->findOneBy(
                        array(
                            'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                            'translatable' => $item->getId(),
                        )
                    );

                if ($youtube) {
                    $youtubes[] = $youtube;
                }
            }

            return $youtubes;
        }

        return null;
    }

    public function orderTransversModules()
    {
        $positions = [];
        $homepage = $this->getHomepageTranslation();

        $positions[$homepage->getTranslatable()->getPositionCatalog()] = 'catalog';
        $positions[$homepage->getTranslatable()->getPositionActualites()] = 'actualite';
        $positions[$homepage->getTranslatable()->getPositionSejour()] = 'sejour';
        $positions[$homepage->getTranslatable()->getPositionSocial()] = 'social';

        ksort($positions);

        return $positions;
    }

    public function orderTransversModulesForProsPage($prosPage)
    {
        $positions = [];

        $positions[$prosPage->getTranslatable()->getPositionCatalog()] = 'catalog';
        $positions[$prosPage->getTranslatable()->getPositionActualites()] = 'actualite';
        $positions[$prosPage->getTranslatable()->getPositionSejour()] = 'sejour';
        $positions[$prosPage->getTranslatable()->getPositionSocial()] = 'social';

        ksort($positions);

        return $positions;
    }
}

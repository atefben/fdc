<?php

namespace FDC\CourtMetrageBundle\Controller;

use Base\CoreBundle\Entity\FilmProjectionProgrammationFilm;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use FDC\CourtMetrageBundle\Component\Controller\Controller;
use FDC\CourtMetrageBundle\Entity\CcmNewsArticle;
use FDC\CourtMetrageBundle\Entity\CcmNewsArticleTranslation;
use FDC\CourtMetrageBundle\Entity\CcmNewsAudio;
use FDC\CourtMetrageBundle\Entity\CcmNewsVideo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MovieController extends Controller
{

    /**
     * @Route("/films/{slug}", name="fdc_ccm_movie_show")
     * @param $slug
     * @param Request $request
     * @return Response
     */
    public function getAction(Request $request, $slug)
    {
        $locale = $request->getLocale();

        $movie = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->findOneBy([
                'slug' => $slug,
            ])
        ;

        if ($movie === null) {
            throw new NotFoundHttpException('Movie not found');
        }

        $movies = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($movie->getFestival()->getId(), $locale, $movie->getSelectionSection()->getId(), $movie->getId())
        ;

        $moviesAll = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getFilmsBySelectionSection($movie->getFestival()->getId(), $locale, $movie->getSelectionSection()->getId())
        ;

        $articles = array();
        $articlesIds = array();
        foreach ($movie->getAssociatedCcmNews() as $associatedNews) {
            if ($associatedNews->getCcmNews()) {
                $article = $associatedNews->getCcmNews();

                if ($article->getPublishedAt() && $this->isPublished($article, $locale)) {
                    if ($article instanceof CcmNewsAudio) {
                        if ($article->getAudio()->getDisplayedHome()) {
                            continue;
                        }
                    }
                    if ($article instanceof CcmNewsVideo) {
                        if ($article->getVideo()->getDisplayedHome()) {
                            continue;
                        }
                    }
                    if ($this->isNewsPublished($article, $locale)) {
                        $key = $article->getPublishedAt()->getTimestamp();
                        $articles[$key] = $article;
                        $articlesIds[] = $article->getId();
                    }
                }
            }
        }

        foreach ($movie->getCcmNews() as $news) {
            if (!in_array($news->getId(), $articlesIds)) {
                if ($news instanceof CcmNewsAudio) {
                    if ($news->getAudio()->getDisplayedHome()) {
                        continue;
                    }
                }
                if ($news instanceof CcmNewsVideo) {
                    if ($news->getVideo()->getDisplayedHome()) {
                        continue;
                    }
                }
                if ($this->isNewsPublished($news, $locale)) {
                    $key = $news->getPublishedAt()->getTimestamp();
                    $articles[$key] = $news;
                    $articlesIds[] = $news->getId();
                }
            }
        }

        foreach ($movie->getAssociatedInfo() as $associatedInfo) {
            if ($associatedInfo->getInfo()) {
                $article = $associatedInfo->getInfo();
                if ($article->getPublishedAt() && $this->isPublished($article, $locale) && $article->findTranslationByLocale('fr')->getIsPublishedOnFDCEvent()) {
                    $key = $article->getPublishedAt()->getTimestamp();
                    $articles[$key] = $article;
                }
            }
        }
        foreach ($movie->getAssociatedStatement() as $associatedStatement) {
            if ($associatedStatement->getStatement()) {
                $article = $associatedStatement->getStatement();
                if ($article->getPublishedAt() && $this->isPublished($article, $locale) && $article->findTranslationByLocale('fr')->getIsPublishedOnFDCEvent()) {
                    $key = $article->getPublishedAt()->getTimestamp();
                    $articles[$key] = $article;
                }
            }
        }

        krsort($articles);

        $prev = null;
        $next = null;
        foreach ($moviesAll as $key => $tmp) {
            if ($tmp->getId() == $movie->getId()) {
                if ($key == 0) {
                    $prev = $movies[count($movies) - 1];
                    $next = $movies[1];
                } elseif ($key == count($movies) - 1) {
                    $prev = $movies[count($movies) - 2];
                    $next = $movies[0];
                } else {
                    if (isset($movies[$key - 1])) {
                        $prev = $movies[$key - 1];
                    }
                    if (isset($movies[$key])) {
                        $next = $movies[$key];
                    }
                }
                break;
            }
        }

        $now = new \DateTime();
        $projections = array();
        foreach ($movie->getProjectionProgrammationFilms() as $projectionProgrammationFilm) {
            if ($projectionProgrammationFilm instanceof FilmProjectionProgrammationFilm && $projectionProgrammationFilm->getProjection()) {
                $projection = $projectionProgrammationFilm->getProjection();
                if ($projection->getStartsAt() && $projection->getStartsAt() > $now) {
                    $projections[$projection->getStartsAt()->getTimestamp()] = $projection->getStartsAt()->format('Y-m-d');
                }
            }
        }
        ksort($projections);
        $nextProjectionDate = '';
        if ($projections) {
            $projections = array_values($projections);
            $nextProjectionDate = $projections[0];
        }

        return $this->render('FDCCourtMetrageBundle:Movie:mainMovie.html.twig', [
                'movie' => $movie,
                'movies' => $movies,
                'prev' => $prev,
                'next' => $next,
                'articles' => $articles,
//                TODO:Should be used when press progam schedule is done. In press.html.twig
                'nextProjectionDate' => $nextProjectionDate,
            ]
        );
    }

    protected function isNewsPublished(CcmNewsArticle $news = null, $locale)
    {
        if ($news) {
            $now = new \DateTime();
            $isPublished = $news->getPublishedAt() && $news->getPublishedAt() <= $now;
            $isPublished = $isPublished && ($news->getPublishEndedAt() === null || $news->getPublishEndedAt() >= $now);
            if ($isPublished) {
                $fr = $news->findTranslationByLocale('fr');
                if ($fr && $fr->getStatus() === TranslateChildInterface::STATUS_PUBLISHED) {
                    if ($locale != 'fr') {
                        $trans = $news->findTranslationByLocale($locale);
                        if ($trans && $trans->getStatus() === TranslateChildInterface::STATUS_TRANSLATED) {
                            return true;
                        }
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    protected function isPublished($article, $locale)
    {
        $translation = $article->findTranslationByLocale($locale);
        if ($locale == 'fr') {
            if ($translation->getStatus() === CcmNewsArticleTranslation::STATUS_PUBLISHED) {
                return true;
            }
        } else {
            $fr = $article->findTranslationByLocale($locale);
            $translated = CcmNewsArticleTranslation::STATUS_TRANSLATED;
            if ($fr->getStatus() === $translated) {
                return true;
            }
        }
    }
}

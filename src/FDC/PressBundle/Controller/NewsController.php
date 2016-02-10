<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\Info;

use \DateTime;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class NewsController extends Controller
{
    /**
     * @Route("/")
     * @Template("FDCPressBundle:News:home.html.twig")
     * @param Request $request
     * @return array
     */
    public function homeAction(Request $request)
    {
        $headerInfo = array(
            'title' => 'Accueil',
            'description' => 'L\'espace presse met également à la disposition du grand public des contenus en libre
                              accès. Journalistes, pour visualiser les contenus et services qui vous sont exclusivement
                              réservés, nous vous invitons à saisir le code qui vous a été délivré par le
                              <a href="#" class="service-presse">service de presse</a>'
        );

        $translator = $this->get('translator');

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET DAY STATEMENT ARTICLES
        $statements = $em
            ->getRepository('BaseCoreBundle:Statement')
            ->getLastStatements($settings->getFestival()->getId(), $dateTime, $locale, 10);

        //GET ALL STATEMENT ARTICLES
        $infos = $em
            ->getRepository('BaseCoreBundle:Info')
            ->getLastInfos($settings->getFestival()->getId(), $dateTime, $locale, 10);

        $pressNews = array_merge($infos, $statements);

        usort($pressNews, function ($a, $b) {
            if ($a->getPublishedAt()->format('Y-m-d H:i:s') == $b->getPublishedAt()->format('Y-m-d H:i:s')) {
                return 0;
            }
            return ($a->getPublishedAt()->format('Y-m-d H:i:s') > $b->getPublishedAt()->format('Y-m-d H:i:s')) ? -1 : 1;
        });

        // Limit Statements & Infos to 10 post
        $homeNews = array_slice($pressNews, 0, 10);

        if ($homeNews === null) {
            throw new NotFoundHttpException();
        }


        $festivalStartsAt = $settings->getFestival()->getFestivalStartsAt();
        $festivalEndsAt = $settings->getFestival()->getFestivalEndsAt();
        $schedulingDays = range($festivalStartsAt->format('d'), $festivalEndsAt->format('d'));
        $schedulingYearMonth = $festivalStartsAt->format('Y')."-".$festivalStartsAt->format('m');
        array_walk($schedulingDays, function (&$value, $schedulingYearMonth) use(&$schedulingYearMonth) {
            $value = $schedulingYearMonth ."-". $value;
        });
        
        $events = array(
            'place' => array(
                'grandTheatre' => array(
                    'events' => array(
                        array(
                            'id' => 3,
                            'title' => 'Orson welles, autopsie d’une légende',
                            'author' => array(
                                'fullName' => 'Elisabet KAPNIST'
                            ),
                            'category' => array(
                                'name' => 'Séance de reprise',
                                'slug' => 'reprise'
                            ),
                            'startAt' => new \DateTime(),
                            'endAt' => new \DateTime(),
                            'duration' => 120,
                            'image' => array(
                                'path' => '//dummyimage.com/46x64/000/fff'
                            ),
                            'place' => 'Grand Théatre Lumière',
                            'competition' => 'Hors compétition'
                        ),
                    )
                ),
                'salleBunuel' => array(
                    'events' => array(
                        array(
                            'id' => 5,
                            'title' => 'Mad max, fury road',
                            'author' => array(
                                'fullName' => 'Elisabet KAPNIST'
                            ),
                            'category' => array(
                                'name' => 'conférence de presse',
                                'slug' => 'press'
                            ),
                            'startAt' => new \DateTime(),
                            'endAt' => new \DateTime(),
                            'duration' => 60,
                            'image' => array(
                                'path' => '//dummyimage.com/46x64/000/fff'
                            ),
                            'place' => 'Grand Théatre Lumière',
                            'competition' => 'Hors compétition'
                        ),
                    )
                ),
            )
        );

        $medias = array(
            array(
                'title' => 'Carol',
                'image' => array(
                    'path' => '//dummyimage.com/55x75/000/fff'
                ),
                'author' => array(
                    'fullName' => 'Todd HAYNES'
                ),
                'trailer' => 4,
                'folder' => 3,
                'photo' => 9
            ),
            array(
                'title' => 'Carol',
                'image' => array(
                    'path' => '//dummyimage.com/55x75/000/fff'
                ),
                'author' => array(
                    'fullName' => 'Todd HAYNES'
                ),
                'trailer' => 4,
                'folder' => 3,
                'photo' => 9
            ),
            array(
                'title' => 'Carol',
                'image' => array(
                    'path' => '//dummyimage.com/55x75/000/fff'
                ),
                'author' => array(
                    'fullName' => 'Todd HAYNES'
                ),
                'trailer' => 4,
                'folder' => 3,
                'photo' => 9
            )
        );

        $festivalDownloads = array(
            array(
                'format' => 'portrait',
                'resolution' => array(
                    array(
                        'size' => 'JPG 72 DPI'
                    ),
                    array(
                        'size' => 'JPG 300 DPI'
                    ),
                ),
                'caption' => '© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of David Seymour - Magnum Photos',
            ),
            array(
                'format' => 'landscape',
                'resolution' => array(
                    array(
                        'size' => 'JPG 72 DPI'
                    ),
                    array(
                        'size' => 'JPG 300 DPI'
                    ),
                ),
                'caption' => '© FDC / Lagency / Taste (Paris) / Ingrid Bergman © David Seymour / Estate of David Seymour - Magnum Photos',
            ),
        );

        $stats = array(
            'title' => 'Lorem Ipsum Dolor Sit Amet',
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                              laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                              architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                              sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.',
            'image' => array(
                'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/003.jpg'
            )
        );

        $movieDownload = array(
            'description' => 'Le Festival de Cannes met à disposition de la presse accréditée les bandes-annonces et
                                  extraits de films fournis par les productions. Ces contenus sont mis à jour tout au
                                  long du Festival. Ce service est fourni pour faciliter le traitement des films sur
                                  vos propres médias. Nous vous prions instamment de ne pas les publier sur les réseaux
                                  sociaux ou les portails de partage de type Youtube ou Dailymotion sans l’accord des
                                  ayants-droits du film.<br><strong>Chaque fois que possible, les fichiers mis à disposition
                                  seront en HD 1080p. Le Festival reste tributaire de la qualité du matériel qui lui est
                                  adressé. 1 à 3 fichiers sont mis à disposition en fonction du fichier source reçu :</strong>',
            'movie' => array(
                'title' => 'Il racconto dei racconti',
                'author' => array(
                    'fullName' => 'Matteo GARRONE'
                ),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/press/media/img6.jpg'
                ),
                'trailers' => array(
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    ),
                    array(
                        'title' => 'Lorem ipsum',
                        'description' => 'Lorem ipsum',
                        'path' => '#'
                    )
                )
            ),
        );

        return array(
            'headerInfo' => $headerInfo,
            'homeNews' => $homeNews,
            'schedulingDays' => $schedulingDays,
            'schedulingEvents' => $events,
            'pressMedias' => $medias,
            'pressFestivalDownloads' => $festivalDownloads,
            'pressMovieDownloads' => $movieDownload,
            'pressStats' => $stats
        );
    }

    /**
     * @Route("/press-articles/{slug}")
     * @Template("FDCPressBundle:News:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        $isAdmin = true;
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET NEWS
        $statement = $em->getRepository('BaseCoreBundle:Statement')->getStatementBySlug(
            $slug,
            $settings->getFestival()->getId(),
            $locale,
            $dateTime->format('Y-m-d H:i:s'),
            $isAdmin
        );

        if ($statement === null) {
            $statement = $em->getRepository('BaseCoreBundle:Info')->getInfoBySlug(
                $slug,
                $settings->getFestival()->getId(),
                $locale,
                $dateTime->format('Y-m-d H:i:s'),
                $isAdmin
            );
        }

        //get associated film to the news
        $associatedFilm = null;
        $associatedProgrammation = null;
        $associatedFilmDuration = null;
        $type = null;
        if ($statement->getAssociatedFilm() != null) {
            $associatedFilm = $statement->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($statement->getAssociatedEvent() != null) {
            $associatedFilm = $statement->getAssociatedEvent()->getAssociatedFilm();
            $associatedFilmDuration = date('H:i', mktime(0, $associatedFilm->getDuration()));
            $associatedProgrammation = $associatedFilm->getProjectionProgrammationFilms();
            $type = 'film';
        } elseif ($statement->getAssociatedProjections() != null) {
            $associatedProgrammation = $statement->getAssociatedProjections();
            $type = 'event';
        }

        //get film projection
        $programmations = array();
        if ($associatedProgrammation != null) {
            foreach ($associatedProgrammation as $projection) {
                if($type == 'event') {
                    $programmations[] = $projection->getAssociation();
                } else {
                    $programmations[] = $projection->getProjection();
                }

            }
        }

        //get focus articles
        if($statement instanceof Statement) {
            $associatedNews = $statement->getAssociatedStatement();
            $focusArticles  = array();
            foreach ($associatedNews as $associatedNew) {
                if($associatedNew->getAssociation() != null) {
                    $focusArticles[] = $associatedNew->getAssociation();
                }
            }
        }
        else {
            $associatedNews = $statement->getAssociatedInfo();
            $focusArticles  = array();
            foreach ($associatedNews as $associatedNew) {
                if($associatedNew->getAssociation() != null) {
                    $focusArticles[] = $associatedNew->getAssociation();
                }
            }
        }


        //get day articles
        $count = 3;


        $statementDate = $statement->getPublishedAt();

        if($statement instanceof Statement) {
            $sameDayArticles = $em->getRepository('BaseCoreBundle:Statement')
                ->getSameDayStatement(
                    $settings->getFestival()->getId(),
                    $locale,
                    $statementDate,
                    $count,
                    $statement->getId()
                );
        }
        else {
            $sameDayArticles = $em->getRepository('BaseCoreBundle:Info')
                ->getSameDayInfo(
                    $settings->getFestival()->getId(),
                    $locale,
                    $statementDate,
                    $count,
                    $statement->getId()
                );
        }

        return array(
            'focusArticles' => $focusArticles,
            'programmations' => $programmations,
            'associatedFilmDuration' => $associatedFilmDuration,
            'news' => $statement,
            'associatedFilm' => $associatedFilm,
            'sameDayArticles' => $sameDayArticles,
        );
    }

    /**
     *
     * @Route("/press-actu")
     * @Template("FDCPressBundle:News:list.html.twig")
     * @return array
     */
    public function listAction()
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET ALL STATEMENT ARTICLES
        $statements = $em->getRepository('BaseCoreBundle:Statement')->getStatements($settings->getFestival()->getId(), $dateTime, $locale);

        //GET ALL STATEMENT ARTICLES
        $infos = $em->getRepository('BaseCoreBundle:Info')->getInfos($settings->getFestival()->getId(), $dateTime, $locale);

        if ($statements === null && $infos === null) {
            throw new NotFoundHttpException();
        }
        $pressNews = array_merge($infos, $statements);

        usort($pressNews, function ($a, $b) {
            if ($a->getCreatedAt()->format('Y-m-d H:i:s') == $b->getCreatedAt()->format('Y-m-d H:i:s')) {
                return 0;
            }
            return ($a->getCreatedAt()->format('Y-m-d H:i:s') > $b->getCreatedAt()->format('Y-m-d H:i:s')) ? -1 : 1;
        });

        $filters = array();
        $filters['dates'][0] = array(
            'slug' => 'all',
            'content' => 'Toutes',
        );

        $filters['themes'][0] = array(
            'slug' => 'all',
            'content' => 'Tous',
        );

        $filters['format'][0] = array(
            'slug' => 'all',
            'content' => 'Tous',
        );

        $statementsTypes = Statement::getTypes();

        $i = 1;
        foreach ($statementsTypes as $statementsType) {
            $filters['format'][$i]['slug'] = $statementsType;
            $filters['format'][$i]['content'] = $statementsType;
            $i++;
        }

        $i = 1;

        $years = array();
        $themes = array();

        foreach ($pressNews as $statement) {

            if (!in_array($statement->getPublishedAt()->format('Y'), $years)) {
                $filters['dates'][$i]['slug'] = $statement->getPublishedAt()->format('Y');
                $filters['dates'][$i]['content'] = $statement->getPublishedAt()->format('Y');

                $years[] = $statement->getPublishedAt()->format('Y');
            }
            if (!in_array($statement->getTheme()->getSlug(), $themes)) {
                $filters['themes'][$i]['slug'] = $statement->getTheme()->getSlug();
                $filters['themes'][$i]['content'] = $statement->getTheme()->getName();

                $themes[] = $statement->getTheme()->getSlug();
            }
            $i++;
        }

        $headerInfo = array(
            'title' => 'Communiqués et infos',
            'description' => 'Communiqués, actualités, retrouvez toute l\'information à ne pas manquer.'
        );

        return array(
            'headerInfo' => $headerInfo,
            'filters' => $filters,
            'pressNews' => $pressNews,
        );

    }

}

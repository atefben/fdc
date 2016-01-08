<?php

namespace FDC\PressBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FDC\PressBundle\Form\Type\LockedContentType;

class NewsController extends Controller
{
    /**
     * @Route("/")
     * @Template("FDCPressBundle:News:home.html.twig")
     * @param Request $request
     * @return array
     */
    public function homeAction( Request $request )
    {
        $headerInfo = array(
            'title' => 'Accueil',
            'description' => 'L\'espace presse met également à la disposition du grand public des contenus en libre
                              accès. Journalistes, pour visualiser les contenus et services qui vous sont exclusivement
                              réservés, nous vous invitons à saisir le code qui vous a été délivré par le
                              <a href="#" class="service-presse">service de presse</a>'
        );

        $translator = $this->get('translator');

        $lockedContentForm = $this->createForm( new LockedContentType($translator) );

        $popinLockedForm = $this->createForm( new LockedContentType($translator));

        $homeNews = array(
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'article',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'article',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'article',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'article',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'article',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'article',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'communique',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'communique',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'communique',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            ),
            array(
                'id' => 0,
                'title' => 'Stéphane Brizé interroge la loi du marché',
                'type'  => 'communique',
                'slug'  => 'stephane-brize-interroge',
                'category' => array(
                    'title' => 'Conférence de presse',
                    'slug'  => 'press'
                ),
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                )
            )
        );

        $schedulingDays = array(
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            ),
            array(
                'date' => new \DateTime(),
            )
        );

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
            'lockedForm' => $lockedContentForm->createView(),
            'popinLockedForm' => $popinLockedForm->createView(),
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
     * @Template("FDCEventBundle:News:main.html.twig")
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();
        //$token = $this->get('security.token_storage')->getToken();
        //$isAdmin = ($token) ? true : false;
        $isAdmin = true;
        $dateTime = new DateTime();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null && $settings->getFestival() !== null) {
            throw new NotFoundHttpException();
        }

        // GET NEWS
        $news = $em->getRepository('BaseCoreBundle:News')->getNewsBySlug(
            $slug,
            $settings->getFestival()->getId(),
            $locale,
            $dateTime->format('Y-m-d H:i:s'),
            $isAdmin
        );

        if ($news === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCEventPageNewsSeo($news, $locale);

        return array(
            'news' => $news,
            //  'article' => $article
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

        $headerInfo = array(
            'title' => 'Communiqués et infos',
            'description' => 'Communiqués, actualités, retrouvez toute l\'information à ne pas manquer.'
        );

        $filters = array(
            'dates' => array(
                array(
                    'slug' => '2016',
                    'content' => '2016',
                ),
                array(
                    'slug' => '2015',
                    'content' => '2015',
                ),
                array(
                    'slug' => '2014',
                    'content' => '2014',
                ),
            ),
            'types' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'communique',
                    'content' => 'Communiqués',
                ),
                array(
                    'slug' => 'info',
                    'content' => 'Infos',
                ),
            ),
            'themes' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'press',
                    'content' => 'Conférence de presse',
                ),
                array(
                    'slug' => 'marche',
                    'content' => 'Montée des marches',
                )
            ),
            'formats' => array(
                array(
                    'slug' => 'all',
                    'content' => 'Tous',
                ),
                array(
                    'slug' => 'article',
                    'content' => 'Articles',
                ),
                array(
                    'slug' => 'video',
                    'content' => 'Videos',
                ),
                array(
                    'slug' => 'audio',
                    'content' => 'Audios',
                ),
                array(
                    'slug' => 'photo',
                    'content' => 'Photos',
                ),
            ),
        );

        $articles = array(
            array(
                'id' => 0,
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'format' => 'article',
                'theme' => 'cinema',
                'category' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/01.jpg',
                ),
                'filters' => array(
                    array(
                        'slug' => 'all'
                    ),
                    array(
                        'slug' => 'communique'
                    )
                )
            ),
            array(
                'id' => 0,
                'title' => 'La Loi du Marché par Stéphane Brizé',
                'format' => 'audio',
                'theme' => 'press',
                'category' => 'Conférence de Presse',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/02.jpg',
                ),
                'filters' => array(
                    array(
                        'slug' => 'all'
                    ),
                    array(
                        'slug' => 'press'
                    ),
                    array(
                        'slug' => 'steps'
                    ),
                )
            ),
            array(
                'id' => 0,
                'title' => 'Enragés, polar hybride d\'Eric Hannezo',
                'format' => 'article',
                'theme' => 'cinema',
                'category' => 'Cinéma de la plage',
                'createdAt' => new \DateTime(),
                'image' => array(
                    'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg',
                ),
                'filters' => array(
                    array(
                        'slug' => 'all'
                    ),
                    array(
                        'slug' => 'press'
                    ),
                    array(
                        'slug' => 'steps'
                    ),
                )
            ),
        );

        return array(
            'headerInfo'  => $headerInfo,
            'newsFilters' => $filters,
            'newsArticle' => $articles,
        );

    }
}

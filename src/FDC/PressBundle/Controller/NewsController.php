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

        if ( $request->isMethod( 'POST' ) ) {

        }

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

        $downloads = array(
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

        return array(
            'lockedForm' => $lockedContentForm->createView(),
            'headerInfo' => $headerInfo,
            'homeNews' => $homeNews,
            'schedulingDays' => $schedulingDays,
            'schedulingEvents' => $events,
            'pressMedias' => $medias,
            'pressDownloads' => $downloads,
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
}

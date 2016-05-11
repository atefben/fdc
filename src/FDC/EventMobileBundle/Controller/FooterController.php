<?php

namespace FDC\EventMobileBundle\Controller;

use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;

use FDC\EventMobileBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FDC\EventMobileBundle\Form\Type\ContactType;
use FDC\EventMobileBundle\Form\Type\NewsletterType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * @Route("/")
 */
class FooterController extends Controller
{
    /**
     * @Route("/static-{page}")
     * @Template("")
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function staticAction($page)
    {

        $pageContent = "";

        $mentionContent = array(
            array(
                'title' => "Propriété intellectuelle",
                'content' => 'Toute reproduction ou distribution non autorisée de tout ou partie des éléments et
                informations de ce site est interdite. Le contenu est disponible pour un usage privé et non collectif.
                Le code de la propriété intellectuelle n\'autorisant, aux termes de l\'article L. 122-5.2° et 3°a,
                d\'une part, que les "copies ou reproductions strictement réservées à l\'usage privé du copiste et non
                destinées à une utilisation collective" et, d\'autre part, que les analyses et les courtes citations
                dans un but d\'exemple et d\'illustration, "toute représentation ou reproduction intégrale ou partielle
                faite sans le consentement de l\'auteur ou de ses ayants droit ou ayants cause est illicite"
                (art. L. 122-4). Cette représentation ou reproduction, par quelque procédé que ce soit constituerait
                donc une contrefaçon sanctionnée par les articles L. 335-2 et suivants du code de la propriété
                intellectuelle.'
            ),
            array(
                'title' => "Propriété intellectuelle",
                'content' => 'Toute reproduction ou distribution non autorisée de tout ou partie des éléments et
                informations de ce site est interdite. Le contenu est disponible pour un usage privé et non collectif.
                Le code de la propriété intellectuelle n\'autorisant, aux termes de l\'article L. 122-5.2° et 3°a,
                d\'une part, que les "copies ou reproductions strictement réservées à l\'usage privé du copiste et non
                destinées à une utilisation collective" et, d\'autre part, que les analyses et les courtes citations
                dans un but d\'exemple et d\'illustration, "toute représentation ou reproduction intégrale ou partielle
                faite sans le consentement de l\'auteur ou de ses ayants droit ou ayants cause est illicite"
                (art. L. 122-4). Cette représentation ou reproduction, par quelque procédé que ce soit constituerait
                donc une contrefaçon sanctionnée par les articles L. 335-2 et suivants du code de la propriété
                intellectuelle.'
            ),
            array(
                'title' => "Propriété intellectuelle",
                'content' => 'Toute reproduction ou distribution non autorisée de tout ou partie des éléments et
                informations de ce site est interdite. Le contenu est disponible pour un usage privé et non collectif.
                Le code de la propriété intellectuelle n\'autorisant, aux termes de l\'article L. 122-5.2° et 3°a,
                d\'une part, que les "copies ou reproductions strictement réservées à l\'usage privé du copiste et non
                destinées à une utilisation collective" et, d\'autre part, que les analyses et les courtes citations
                dans un but d\'exemple et d\'illustration, "toute représentation ou reproduction intégrale ou partielle
                faite sans le consentement de l\'auteur ou de ses ayants droit ou ayants cause est illicite"
                (art. L. 122-4). Cette représentation ou reproduction, par quelque procédé que ce soit constituerait
                donc une contrefaçon sanctionnée par les articles L. 335-2 et suivants du code de la propriété
                intellectuelle.'
            ),

        );

        $sitemapContent = array(
            array(
                'title'=>'L\'actualité',
                'links'=>array(
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Articles',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Photos',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Vidéos',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Audios',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'Web TV',
                'links'=>array(
                    array(
                        'name' => 'En Direct',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Chaînes',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Bandes Annonces',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'La Selection',
                'links'=>array(
                    array(
                        'name' => 'En Compétition',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Un Certain Regard',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Hors Compétition',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Scéances Spéciales',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Cinéfondation',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Courts Métrages',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Cannes Classics',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Cinéma de la Plage',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'Les Jurys',
                'links'=>array(
                    array(
                        'name' => 'Longs Métrages',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Cinéfondation & Courts Métrages',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Un Certain Regard',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Caméra d\'or',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'Le Palmarès',
                'links'=>array(
                    array(
                        'name' => 'Compétition',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Un Certain Regard',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Cinéfondation',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Caméra d\'or',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Tous le palmares',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'Les évènements',
                'links'=>array(
                    array(
                        'name' => 'Leçons',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Expositions',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Rendez-vous européen',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Leçons de musique',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Leçons de cinéma',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Leçons d\'acteur',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Hommages',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'Participer',
                'links'=>array(
                    array(
                        'name' => 'Préparer son séjour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Festival mode d\'emploi',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Accès aux projections',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Partenaires',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Fournisseurs',
                        'path' => '#'
                    )
                )
            ),
            array(
                'title'=>'Espace Presse',
                'links'=>array(
                    array(
                        'name' => 'Accueil',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Communiqués / Infos',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'S\'accréditer',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Guide Pratique',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Programmation',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Médiathèque',
                        'path' => '#'
                    )
                )
            )
        );

        $faqContent = array(
            array(
                'name'    => 'Informations générales',
                'slug'    => 'informations-generales',
                'articles' => array(
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    )
                )
            ),
            array(
                'name'    => 'Informations générales',
                'slug'    => 'accreditation',
                'articles' => array(
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    )
                )
            ),
            array(
                'name'    => 'Informations générales',
                'slug'    => 'accreditation',
                'articles' => array(
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    )
                )
            ),
            array(
                'name'    => 'Informations générales',
                'slug'    => 'accreditation',
                'articles' => array(
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    )
                )
            ),
            array(
                'name'    => 'Informations générales',
                'slug'    => 'accreditation',
                'articles' => array(
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    )
                )
            ),
            array(
                'name'    => 'Informations générales',
                'slug'    => 'accreditation',
                'articles' => array(
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    ),
                    array(
                        'title'   => 'Quelle est la date du prochain festival ?',
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo est numquam provident.
                Neque praesentium eos, placeat adipisci assumenda possimus laudantium fugiat quisquam in necessitatibus
                inventore repellendus, temporibus, debitis, atque nisi? Quod modi veniam a, facere alias aliquid,
                asperiores perferendis cum ratione iste recusandae voluptatibus qui quasi illum? Repudiandae maiores
                consectetur sapiente modi suscipit possimus asperiores impedit at sunt id numquam natus eos dignissimos
                perspiciatis sed assumenda necessitatibus, aut autem eligendi labore, tempore debitis iure voluptatem.
                Dolor, repellat, placeat. Maxime, esse?'
                    )
                )
            ),

        );

        $appliContent = "";

        switch ($page) {
            case 'faq':
                $pageContent = $faqContent;
                break;
            case 'mentions-legales':
                $pageContent = $mentionContent;
                break;
            case 'plan-du-site':
                $pageContent = $sitemapContent;
                break;
            case 'credits':
                $pageContent = $mentionContent;
                break;
            case 'application-mobile':
                $pageContent = $appliContent;
                break;
            case 'nous-rejoindre':
                $pageContent = $mentionContent;
                break;
            case 'politique-confidentialite':
                $pageContent = $mentionContent;
                break;
        }

        return $this->render(
            "FDCEventMobileBundle:Footer:$page.html.twig",
            array('content' => $pageContent)
        );
    }

    /**
     * @Route("/privacy")
     * @Template("FDCEventMobileBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function privacyAction(Request $request) {

        $locale   = $request->getLocale();
        $pageId = $this->getParameter('admin_fdc_footer_confidentialite_id');
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->findOneBy(
            array('id' => $pageId)
        );

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
        );
    }

    /**
     * @Route("/mentions-legales")
     * @Template("FDCEventMobileBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function mentionsLegalesAction(Request $request) {

        $locale   = $request->getLocale();
        $pageId = $this->getParameter('admin_fdc_footer_mentions_legales_id');
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->findOneBy(
            array('id' => $pageId)
        );

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
        );
    }

    /**
     * @Route("/credits")
     * @Template("FDCEventMobileBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function creditsAction(Request $request) {

        $locale   = $request->getLocale();
        $pageId = $this->getParameter('admin_fdc_footer_credits_id');
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->findOneBy(
            array('id' => $pageId)
        );

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
        );
    }

    /**
     * @Route("/page/{slug}", options={"expose"=true})
     * @Template("FDCEventMobileBundle:Footer:footer_page.html.twig")
     * @return array
     */
    public function pageLibresAction(Request $request, $slug) {

        $locale   = $request->getLocale();
        $em = $this->get('doctrine')->getManager();

        $content = $em->getRepository('BaseCoreBundle:FDCPageFooter')->getPageBySlug($slug, $locale);
        if ($content == null) {
            throw new NotFoundHttpException();
        }
        $localeSlugs = $content->getLocaleSlugs();

        // SEO
        $this->get('base.manager.seo')->setFDCPageFooterSeo($content, $locale);

        return array(
            'page' => $content,
            'localeSlugs' => $localeSlugs,
        );
    }

    /**
     * @Route("/faq")
     * @Template("FDCEventMobileBundle:Footer:faq.html.twig")
     * @return array
     */
    public function faqAction(Request $request) {

        $em = $this->get('doctrine')->getManager();
        $themes = $em->getRepository('BaseCoreBundle:FAQTheme')->findAll();
        $faq = array();
        foreach($themes as $key => $theme) {
            $faq[$key]['faq'] = $em->getRepository('BaseCoreBundle:FAQPage')->findby(
                array('theme' => $theme)
            );
            $faq[$key]['theme'] = $theme;
        }

        return array(
            'faq' => $faq
        );
    }

    /**
     * @Route("/sitemap")
     * @Template("FDCEventMobileBundle:Footer:plan-du-site.html.twig")
     * @return array
     */
    public function siteMapAction(Request $request) {

        $locale = $request->getLocale();
        $em     = $this->get('doctrine')->getManager();

        //routes from menu
        $routes = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->childrenHierarchy();

        // Menu Participer
        $participatePage    = $em->getRepository('BaseCoreBundle:FDCPageParticipate')->findAll();
        $preparePage        = $em->getRepository('BaseCoreBundle:FDCPagePrepare')->findById($this->getParameter('admin_fdc_page_prepare_id'));

        $participateMenu = array_merge($preparePage, $participatePage);

        $displayedRoutes = array();
        $press = array();
        foreach($routes as $menu){
            if($menu['site'] == FDCEventRoutesInterface::EVENT){
                $displayedRoutes[] = $menu;
            }

            if($menu['site'] == FDCEventRoutesInterface::PRESS){
                $press[] = $menu;
            }
        }

        // la selection
        $selectionTabs = $em
            ->getRepository('BaseCoreBundle:FDCPageLaSelection')
            ->getPagesOrdoredBySelectionSectionOrder($locale)
        ;
        $cannesClassics = $em->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')->getAll($locale);

        //jury
        $jury = $em
            ->getRepository('BaseCoreBundle:FDCPageJury')
            ->getPages($locale)
        ;

        //palmares
        $award = $em
            ->getRepository('BaseCoreBundle:FDCPageAward')
            ->getPages($locale)
        ;

        //footer
        $displayedFooterElements = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->findBy(
            array('type' => 2),
            array('position' => 'asc'),
            null,
            null
        );

        //events
        $festival = $this->getFestival()->getId();
        $events = $em
                ->getRepository('BaseCoreBundle:Event')
                ->getEvents($festival, $locale)
        ;

        return array(
            'events'            => $events,
            'participate'       => $participateMenu,
            'footer'            => $displayedFooterElements,
            'press'             => $press,
            'award'             => $award,
            'jury'              => $jury,
            'cannesClassics'    => $cannesClassics,
            'selectionTabs'     => $selectionTabs,
            'routes'            => $displayedRoutes
        );
    }

    /**
     * @Route("/contact")
     * @Template("FDCEventMobileBundle:Footer:contact.html.twig")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');
        $hasErrors = false;
        $themes = $em->getRepository('BaseCoreBundle:ContactTheme')->findSelectValues($locale);
        $form = $this->createForm(new ContactType($themes, $translator));

        if ($request->isMethod('POST')) {
            $form->submit($request);
            $theme = $em->getRepository('BaseCoreBundle:ContactTheme')->findOneById($form->get('select')->getData());
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo($theme->getEmail())
                    ->setContentType('text/html')
                    ->setBody(
                        $this->renderView(
                            'FDCEventMobileBundle:Mail:contact.html.twig',
                            array(
                                'contact_email' => $form->get('email')->getData(),
                                'contact_ip' => $request->getClientIp(),
                                'contact_name' => $form->get('name')->getData(),
                                'contact_subject' => $form->get('subject')->getData(),
                                'contact_theme' => $form->get('select')->getData(),
                                'contact_message' => $form->get('message')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->add('success', 'Email sent');
            } else {
                $hasErrors = true;
            }
        }

        return array(
            'form' => $form->createView(),
            'hasErrors' => $hasErrors
        );

    }

    /**
     * Generate the podcast feed
     * @Route("/podcast")
     * @return Response XML Feed
     */
    public function podcastAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $dateTime = new DateTime();

        $audios = $em->getRepository('BaseCoreBundle:Media')->getAudioMedia($locale, $settings->getFestival()->getId(), $dateTime);
        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($audios);

        return new Response($feed->render('rss')); // ou 'atom'
    }

    /**
     * Generate the news rss feed
     * @Route("/rss")
     * @return Response XML Feed
     */
    public function rssFeedAction(Request $request)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');

        $newsArticles = $em->getRepository('BaseCoreBundle:News')->getAllNews($locale, $settings->getFestival()->getId());
        $newsArticles = $this->removeUnpublishedNewsAudioVideo($newsArticles, $locale);

        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($newsArticles);

        return new Response($feed->render('rss')); // ou 'atom'
    }
}

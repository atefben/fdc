<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use FDC\EventBundle\Form\Type\ContactType;
use FDC\EventBundle\Form\Type\NewsletterType;



/**
 * @Route("/")
 */
class FooterController extends Controller
{
    /**
     * @Route("/static-{page}")
     * @Template("FDCEventBundle:Footer:footer.$page.html.twig")
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
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                )
            ),
            array(
                'title'=>'L\'actualité',
                'links'=>array(
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                )
            ),
            array(
                'title'=>'L\'actualité',
                'links'=>array(
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                )
            ),
            array(
                'title'=>'L\'actualité',
                'links'=>array(
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
                    array(
                        'name' => 'Jour Après Jour',
                        'path' => '#'
                    ),
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

        return array(
            'content' => $pageContent
        );

    }

    /**
     * @Route("/contact")
     * @Template("FDCEventBundle:Footer:contact.html.twig")
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

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('lrocher@webqam.fr')
                    ->setBody(
                        $this->renderView(
                            'FDCEventBundle:Mail:mail.contact.html.twig',
                            array(
                                'contact_ip' => $request->getClientIp(),
                                'contact_name' => $form->get('name')->getData(),
                                'contact_subject' => $form->get('subject')->getData(),
                                'contact_theme' => $form->get('select')->getData(),
                                'contact_message' => $form->get('message')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);

                return $this->redirect($this->generateUrl('fdc_event_contact'));
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
     * @Route( "/register-newsletter" )
     * @Template("FDCEventBundle:Footer:newsletter.html.twig")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newsletterAction( Request $request )
    {
        $translator = $this->get('translator');

        $newsForm = $this->createForm( new NewsletterType($translator) );

        if ( $request->isMethod( 'POST' ) ) {

            $newsForm->submit($request);

            if ( $newsForm->isValid( ) ) {

                $data = $newsForm->getData();
                $email = $data['email'];
                $response['success'] = $email;

                $message = \Swift_Message::newInstance()
                    ->setSubject($translator->trans('newsletter.email.subject'))
                    ->setFrom('contact@mail.fr')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'FDCEventBundle:Mail:mail.newsletter.html.twig',
                            array(
                                'newsletter_email' => $email
                            )
                        )
                    );

                $this->get('mailer')->send($message);

            }
            else{

                $response['success'] = false;
                $response['cause'] = 'whatever';

            }

            return new JsonResponse( $response );

        }

        return array(
            'newsform' => $newsForm->createView()
        );

    }

}

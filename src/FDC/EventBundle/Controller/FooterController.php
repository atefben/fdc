<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
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

        return $this->render(
            "FDCEventBundle:Footer:$page.html.twig",
            array('content' => $pageContent)
        );


    }

    /**
     * @Route("/privacy")
     * @Template("FDCEventBundle:Footer:footer_page.html.twig")
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
     * @Template("FDCEventBundle:Footer:footer_page.html.twig")
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
     * @Template("FDCEventBundle:Footer:footer_page.html.twig")
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
     * @Route("/faq")
     * @Template("FDCEventBundle:Footer:faq.html.twig")
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
     * @Template("FDCEventBundle:Footer:plan-du-site.html.twig")
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

        return array(
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
            $theme = $em->getRepository('BaseCoreBundle:ContactTheme')->findOneById($form->get('select')->getData());
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo($theme->getEmail())
                    ->setContentType('text/html')
                    ->setBody(
                        $this->renderView(
                            'FDCEventBundle:Mail:contact.html.twig',
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
}

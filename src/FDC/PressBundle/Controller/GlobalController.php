<?php

namespace FDC\PressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/")
 */
class GlobalController extends Controller
{

    /**
     * @Route("/press-contact")
     * @Template("FDCPressBundle:Global:contact.html.twig")
     * @return array
     * @throws NotFoundHttpException
     */
    public function contactAction()
    {

        $em = $this->getDoctrine()->getManager();

        // GET FDC SETTINGS
        $contact = $em->getRepository('BaseCoreBundle:ContactPage')->findAll();
        $contactPage = $contact[0];
        if ($contactPage === null ) {
            throw new NotFoundHttpException();
        }
        $contact = array(
            'section' => array(
                array(
                    'title' => 'Festival de Cannes - Service de Presse',
                    'contacts' => array(
                        array(
                            'content' => '3, rue Amélie F-75007 Paris<br>Tel : +33 (0)1 53 59 61 85<br>Fax : +33 (0)1 53 59 61 84'
                        ),
                        array(
                            'content' => '<strong>Presse écrite et digitale - Agences de Presse</strong><br><a class="mail" href="mailto:presse@festival-cannes.fr">presse@festival-cannes.fr</a>'
                        ),
                        array(
                            'content' => '<strong>Médias Web</strong><br><a class="mail" href="mailto:webmedia@festival-cannes.fr">webmedia@festival-cannes.fr</a>'
                        )
                    )
                ),
                array(
                    'title' => 'Festival de Cannes - Service de Presse',
                    'contacts' => array(
                        array(
                            'content' => '3, rue Amélie F-75007 Paris<br>Tel : +33 (0)1 53 59 61 85<br>Fax : +33 (0)1 53 59 61 84'
                        ),
                        array(
                            'content' => '<strong>Presse écrite et digitale - Agences de Presse</strong><br><a class="mail" href="mailto:presse@festival-cannes.fr">presse@festival-cannes.fr</a>'
                        ),
                        array(
                            'content' => '<strong>Médias Web</strong><br><a class="mail" href="mailto:webmedia@festival-cannes.fr">webmedia@festival-cannes.fr</a>'
                        )
                    )
                ),
                array(
                    'title' => 'Festival de Cannes - Service de Presse',
                    'contacts' => array(
                        array(
                            'content' => '3, rue Amélie F-75007 Paris<br>Tel : +33 (0)1 53 59 61 85<br>Fax : +33 (0)1 53 59 61 84'
                        ),
                        array(
                            'content' => '<strong>Presse écrite et digitale - Agences de Presse</strong><br><a class="mail" href="mailto:presse@festival-cannes.fr">presse@festival-cannes.fr</a>'
                        ),
                        array(
                            'content' => '<strong>Médias Web</strong><br><a class="mail" href="mailto:webmedia@festival-cannes.fr">webmedia@festival-cannes.fr</a>'
                        )
                    )
                )
            )
        );

        return array(
            'pressContact' => $contactPage
        );

    }

}

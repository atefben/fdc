<?php
namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Form\Type\ContactType;

/**
 * @Route("/event")
 */
class FormController extends Controller
{

    /**
     * @Route("/contact", name="fdc_event_contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function contactAction(Request $request)
    {

        $form = $this->createForm(new ContactType());

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

                $request->getSession()->getFlashBag()->add('success', 'message');

                return $this->redirect($this->generateUrl('fdc_event_contact'));
            }
            else {
                $errors = $form->getErrors(true);
                var_dump($errors[0]);
                exit;
            }
        }

        return $this->render(
            "FDCEventBundle:Footer:footer.contact.html.twig",
            array('form' => $form->createView())
        );


    }
}
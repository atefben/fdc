<?php

namespace FDC\CourtMetrageBundle\Controller;

use DateTime;
use Exception;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FDC\CourtMetrageBundle\Form\Type\ShareEmailType;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return;
    }


    /**
     * @Route("/share-email-ccm", name="fdc_court_metrage_shareemail", options={"expose"=true})
     * @param Request $request
     * @param null    $section
     * @param null    $detail
     * @param null    $title
     * @param null    $description
     * @param null    $url
     * @param null    $artist
     *
     * @return JsonResponse
     */
    public function shareEmailAction(Request $request, $section = null, $detail = null, $title = null, $description = null, $url = null, $artist = null) {
        $email = array(
            'section' => $section,
            'detail' => $detail,
            'title' => $title,
            'description' => $description,
            'url' => $url
        );

        $translator = $this->get('translator');
        $hasErrors  = false;

        $form = $this->createForm(new ShareEmailType($translator, $artist));
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form['email']->isValid()) {
                $emails = explode(',', $form['email']->getData());
                foreach ($emails as $email) {
                    if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                        $error = new FormError('email.invalid');
                        $form['email']->addError($error);
                        break;
                    }
                }
            }

            if ($form->isValid()) {
                $emailTemplate = 'FDCCourtMetrageBundle:Emails:share.html.twig';
                foreach ($emails as $email){
                    $data    = $form->getData();
                    $artist = $request->get('artist');
                    $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($email)->setBody($this->renderView($emailTemplate, array(
                        'message' => $data['message'],
                        'section' => $data['section'],
                        'title' => $data['title'],
                        'description' => strip_tags($data['description'], '<p><em>'),
                        'detail' => $data['detail'],
                        'url' => $data['url'],
                        'artist' => ($artist != null) ? $this->getDoctrine()->getManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist) : null
                    )), 'text/html');
                    $mailer  = $this->get('mailer');
                    $mailer->send($message);

                    $response['success'] = true;

                    //send mail copy
                    if ($data['copy']) {
                        $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($data['user'])->setBody($this->renderView($emailTemplate, array(
                            'message' => $data['message'],
                            'section' => $data['section'],
                            'title' => $data['title'],
                            'description' => strip_tags($data['description'], '<p><em>'),
                            'detail' => $data['detail'],
                            'url' => $data['url'],
                            'artist' => ($artist != null) ? $this->getDoctrine()->getManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist) : null
                        )), 'text/html');
                        $mailer  = $this->get('mailer');
                        $mailer->send($message);
                    }

                    // subscribe to newsletter
                    if ($data['newsletter']) {
                        $locale = ($request->getLocale() == 'fr') ? 'fr' : 'en';
                        $exist = $this->newsletterEmailExists($data['user']);
                        if ($exist == false) {
                            $subscribed = $this->newsletterEmailSubscribe($data['email'], $locale);
                        }
                    }
                }
            } else {
                $response['success'] = false;
            }
            return new JsonResponse($response);
        }

        if ($artist) {

            return $this->render('FDCCourtMetrageBundle:Shared:shareMail.html.twig', [
                'share_email' => $email,
                'form' => $form->createView(),
                'hasErrors' => $hasErrors,
                'artist' => $this->getDoctrine()->getManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist)
            ]);
        } else {

            return $this->render('FDCCourtMetrageBundle:Shared:shareMail.html.twig', [
                'share_email' => $email,
                'form' => $form->createView(),
                'hasErrors' => $hasErrors,
            ]);
        }
    }

    private function newsletterEmailExists($email)
    {
        $client = new Client($this->container->getParameter('fdc_newsletter_api_url'));
        $request = $client->get('contact/' . $email);
        $request->setAuth(
            $this->container->getParameter('fdc_newsletter_api_universe'),
            $this->container->getParameter('fdc_newsletter_api_password')
        );

        try {
            $request->send();
        } catch (BadResponseException $e) {
            $this->get('logger')->err('Unable to verify if email exists in newsletter - '. $e->getMessage());
            return false;
        } catch (Exception $e) {
            $this->get('logger')->err('Unexpected error when verifying if email exists in newsletter - '. $e->getMessage());
            return false;
        }

        return ($request->getResponse()->getStatusCode() === 200) ? true : false;
    }

    private function newsletterEmailSubscribe($email, $locale)
    {
        $date = new DateTime();
        $client = new Client($this->container->getParameter('fdc_newsletter_api_url'));
        $query = json_encode(array(
             'email' => $email,
             'lang' => $locale,
             'date' => $date->format('Y-m-d H:i:s'),
             'firstname' => '',
             'lastname' => '',
             'lists' => array(
                 array('id' => '0')
             )
         ));
        $request = $client->post('contact/', null, $query);

        $request->setAuth(
            $this->container->getParameter('fdc_newsletter_api_universe'),
            $this->container->getParameter('fdc_newsletter_api_password')
        );

        try {
            $request->send();
        } catch (BadResponseException $e) {
            $this->get('logger')->err('Unable to verify if '. $email. ' exists in newsletter - '. $e->getMessage());
            return false;
        }  catch (Exception $e) {
            $this->get('logger')->err('Unexpected error when subscribing '. $email. ' in newsletter - '. $e->getMessage());
            return false;
        }

        return true;
    }
}

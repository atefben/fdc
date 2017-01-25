<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Form\Type\MobileSettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/mobile-settings")
 */
class MobileSettingsController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $admin_pool = $this->get('sonata.admin.pool');
        $data = array(
            'iosVersion'        => $this->get('base.variable')->get('iosVersion'),
            'androidVersion'    => $this->get('base.variable')->get('androidVersion'),
            'countdown'         => $this->get('base.variable')->get('countdown'),
            'countdownTime'     => $this->get('base.variable')->get('countdownTime'),
            'mobileRedirect'    => $this->get('base.variable')->get('mobileRedirect'),
            'mobileRedirectUrl' => $this->get('base.variable')->get('mobileRedirectUrl'),
        );

        $form = $this->createForm(new MobileSettingsType(), $data);


        if ($request->isMethod('post')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                foreach (array_keys($data) as $name) {
                    $this->get('base.variable')->set($name, $form->get($name)->getData());
                }
                $msgModified = $this
                    ->get('translator')
                    ->trans('form.flashbag.modified', [], 'BaseAdminBundle')
                ;
                $this->addFlash('success', $msgModified);

                return $this->redirectToRoute('base_admin_mobilesettings_index', array(
                    'admin_pool' => $admin_pool,
                ));
            }
        }
        return $this->render('BaseAdminBundle:Settings:mobile_settings.html.twig', [
            'admin_pool' => $admin_pool,
            'form'       => $form->createView(),
        ]);
    }
}
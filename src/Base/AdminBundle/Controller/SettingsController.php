<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Form\Type\SettingsType;
use Base\CoreBundle\Entity\Settings;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * Settings controller.
 * @author   Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 *
 * @Route("/settings")
 */
class SettingsController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $admin_pool = $this->get('sonata.admin.pool');
        $em = $this->getDoctrine()->getManager();

        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneById(1);
        $settings = ($settings !== null) ? $settings : new Settings();


        $form = $this->get('form.factory')->create(new SettingsType(), $settings);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($settings);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Modification effectué');

            return $this->redirectToRoute('base_admin_settings_index', array(
                'admin_pool' => $admin_pool
            ));
        }

        return array(
            'admin_pool' => $admin_pool,
            'form' => $form
        );
    }
}
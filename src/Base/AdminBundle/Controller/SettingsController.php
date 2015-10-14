<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Form\Type\SettingsFDCApiYearType;
use Base\AdminBundle\Form\Type\SettingsFDCYearType;
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

        $settingsFDCYear = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $settingsFDCYear = ($settingsFDCYear !== null) ? $settingsFDCYear : new Settings();

        $settingsFDCApiYear  = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-api-year');
        $settingsFDCApiYear = ($settingsFDCApiYear !== null) ? $settingsFDCApiYear : new Settings();


        $formFDCYear = $this->get('form.factory')->create(new SettingsFDCApiYearType(), $settingsFDCYear);
        $formFDCYear->handleRequest($request);

        $formFDCApiYear = $this->get('form.factory')->create(new SettingsFDCYearType(), $settingsFDCApiYear);
        $formFDCApiYear->handleRequest($request);

        if ($formFDCYear->isValid()) {
            $em->persist($settingsFDCYear);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Modification effectué');

            return $this->redirectToRoute('base_admin_settings_index', array(
                'admin_pool' => $admin_pool
            ));
        }

        if ($formFDCApiYear->isValid()) {
            $em->persist($settingsFDCApiYear);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Modification effectué');

            return $this->redirectToRoute('base_admin_settings_index', array(
                'admin_pool' => $admin_pool
            ));
        }


        return array(
            'admin_pool' => $admin_pool,
            'formFDCYear' => $formFDCYear->createView(),
            'formFDCApiYear' => $formFDCApiYear->createView()
        );
    }
}
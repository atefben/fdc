<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Form\Type\PressPasswordType;
use Base\AdminBundle\Form\Type\SettingsFDCApiYearType;
use Base\AdminBundle\Form\Type\SettingsFDCYearType;
use Base\CoreBundle\Entity\Settings;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $msgModified = $this->get('translator')->trans('form.flashbag.modified', array(), 'BaseAdminBundle');

        if ($formFDCYear->isValid()) {
            $em->persist($settingsFDCYear);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', $msgModified);

            return $this->redirectToRoute('base_admin_settings_index', array(
                'admin_pool' => $admin_pool
            ));
        }

        if ($formFDCApiYear->isValid()) {
            $em->persist($settingsFDCApiYear);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', $msgModified);

            return $this->redirectToRoute('base_admin_settings_index', array(
                'admin_pool' => $admin_pool
            ));
        }

        // Get Press user
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername('press');
        if ($user === null) {
            throw new NotFoundHttpException();
        }
        //Password form
        $formPressPassword = $this->get('form.factory')->create(new PressPasswordType(), $user);
        $formPressPassword->handleRequest($request);

        if ($formPressPassword->isValid()) {
            $em->persist($user);
            $this->get('fos_user.user_manager')->updateUser($user, false);

            $this->getDoctrine()->getManager()->flush();
            $request->getSession()->getFlashBag()->add('success', $msgModified);
            return $this->redirectToRoute('base_admin_settings_index', array(
                'admin_pool' => $admin_pool
            ));

        }

        return array(
            'admin_pool' => $admin_pool,
            'formFDCYear' => $formFDCYear->createView(),
            'formFDCApiYear' => $formFDCApiYear->createView(),
            'formPressPassword' => $formPressPassword->createView(),
        );
    }
}
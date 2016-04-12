<?php

namespace Base\AdminBundle\Controller;

use Application\Sonata\AdminBundle\Controller\CRUDController;

class FDCEventRoutesAdminController extends CRUDController
{

    public function treeAction() {
        $em = $this->getDoctrine()->getManager();
        $filters = $this->admin->getFilterParameters();
        $qb = $em->getRepository($this->admin->getClass())->getRootNodesQueryBuilder('position', 'asc');
        $objects = $qb->getQuery()->getResult();
        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('BaseAdminBundle:FDCEventRoutes:tree.html.twig', array(
            'action'      => 'translation',
            'objects'       => $objects,
            'form'        => $formView,
        ));
    }

}

<?php

namespace Application\Sonata\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as BaseController;

use Symfony\Component\HttpFoundation\RedirectResponse;

class CRUDController extends BaseController
{
    /**
     * Redirect the user depend on this choice.
     *
     * @param object $object
     *
     * @return RedirectResponse
     */
    protected function redirectTo($object)
    {
        $url = false;

        if (isset($_GET['list']) && $_GET['list'] == true) {
            $url = $this->admin->generateUrl('list');
        }

        if (null !== $this->get('request')->get('btn_create_and_create')) {
            $params = array();
            if ($this->admin->hasActiveSubClass()) {
                $params['subclass'] = $this->get('request')->get('subclass');
            }
            $url = $this->admin->generateUrl('create', $params);
        }


        if ($this->getRestMethod() == 'DELETE') {
            $url = $this->admin->generateUrl('list');
        }

        if (!$url) {
            $params = array();
            if (isset($_GET['locale'])) {
                $params['locale'] = $_GET['locale'];
            }

            $url = $this->admin->generateObjectUrl('edit', $object, $params);
        }

        return new RedirectResponse($url);
    }
}
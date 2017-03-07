<?php

namespace Base\AdminBundle\Controller\CCM;


use FDC\CourtMetrageBundle\Entity\CcmNews;
use Sonata\AdminBundle\Controller\CRUDController;

class NewsController extends CRUDController
{
    /**
     * @param null $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction($id = null)
    {
        /** @var CcmNews $object */
        $object = $this->admin->getSubject();

        if (!($object instanceof CcmNews)) {
            throw $this->createNotFoundException();
        }

        /**
         * we generate the URL for the appropriate news admin
         * depending on the type (article,image,video,audio)
         */
        $url = $this->generateUrl('ccm_news_' . $object->getType() . '_edit', [
            'id' => $id
        ]);

        return $this->redirect($url);
    }
}
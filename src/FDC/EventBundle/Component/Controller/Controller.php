<?php

namespace FDC\EventBundle\Component\Controller;

use Base\CoreBundle\Entity\Settings;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * @return ObjectManager
     */
    public function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @return Settings
     * @throws NotFoundHttpException
     */
    public function getSettings()
    {
        $settings = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');

        if ($settings === null) {
            throw $this->createNotFoundException();
        }
        return $settings;
    }

    /**
     * @param $name
     * @param $arguments
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function __call($name, $arguments)
    {
        if (substr($name, 0, 11) === 'getBaseCore' && substr($name, -10) === 'Repository') {
            return $this->getDoctrineManager()->getRepository('BaseCoreBundle:' . str_replace(['getBaseCore', 'Repository'], '', $name));
        }
        throw $this->createNotFoundException("The methods $name does not exist.");
    }

    /**
     * @return Settings
     * @throws NotFoundHttpException
     */
    public function getFestival()
    {

        if (!$this->getSettings() || $this->getSettings()->getFestival() === null) {
            throw $this->createNotFoundException();
        }

        return $this->getSettings()->getFestival();
    }


}
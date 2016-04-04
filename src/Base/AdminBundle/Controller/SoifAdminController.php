<?php

namespace Base\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class SoifAdminController
 * @package Base\AdminBundle\Controller
 */
class SoifAdminController extends CRUDController
{
    /**
     * @var array
     */
    private static $entitiesToSoifCommand = array(
        'Base\CoreBundle\Entity\FilmAward' => 'get_award',
        'Base\CoreBundle\Entity\Country' => 'get_country',
        'Base\CoreBundle\Entity\FilmFestival' => 'get_festival',
        'Base\CoreBundle\Entity\FilmFestivalPoster' => 'get_festival_poster',
        'Base\CoreBundle\Entity\FilmFilm' => 'get_film',
        'Base\CoreBundle\Entity\FilmAtelier' => 'get_film_atelier',
        'Base\CoreBundle\Entity\FilmJury' => 'get_jury',
        'Base\CoreBundle\Entity\FilmMedia' => 'get_media',
        'Base\CoreBundle\Entity\FilmMediaCategory' => 'get_media_category',
        'Base\CoreBundle\Entity\FilmPerson' => 'get_person',
        'Base\CoreBundle\Entity\FilmPrize' => 'get_prize',
        'Base\CoreBundle\Entity\FilmProjection' => 'get_projection'
    );

    /**
     * Check the class name and try to find the equivalent Soif Command
     * @param $object
     * @return null
     */
    private function getSoifCommand($object)
    {
        return (isset(self::$entitiesToSoifCommand[get_class($object)])) ? self::$entitiesToSoifCommand[get_class($object)] : null;
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws AccessDeniedException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function soifRefreshAction($id)
    {
        $object = $this->admin->getObject($id);


        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SOIF') === false) {
            throw new AccessDeniedHttpException();
        }

        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'base:soif:'. $this->getSoifCommand($object),
            'id' => $object->getId()
        ));
        $output = new NullOutput();
        $application->run($input, $output);

        $url = $this->admin->generateUrl('list');

        return new RedirectResponse($url);
    }
}

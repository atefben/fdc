<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\MediaAudio;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SearchController
 * @package Base\ApiBundle\Controller
 */
class SearchController extends FOSRestController
{
    private static $entityMapper = array(
        'event'       => 'Event',
        'info'        => 'Info',
        'artist'      => 'FilmPerson',
        'statement'   => 'Statement',
        'media'       => 'Media',
        'film'        => 'FilmFilm',
        'news'        => 'News',
        'participate' => 'FDCPageParticipate',
    );

    /**
     * Get results of search
     * @Rest\Route("/search")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get results of search",
     *   section="Search",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function searchAction(Request $request, ParamFetcher $paramFetcher)
    {
        //core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        $searchTerm = $request->query->get('s');
        $locale = $paramFetcher->get('lang');
        $festival = $coreManager->getApiFestivalYear();

        if ($searchTerm) {

            $newsResults = $this->getSearchResults($locale, 'news', $searchTerm, 4);
            $infoResults = $this->getSearchResults($locale, 'info', $searchTerm, 4);
            $statementResults = $this->getSearchResults($locale, 'statement', $searchTerm, 2);
            $eventResults = $this->getSearchResults($locale, 'event', $searchTerm, 2);
            $mediaResults = $this->getSearchResults($locale, 'media', $searchTerm, 2);
            $filmResults = $this->getSearchResults($locale, 'film', $searchTerm, 4, 1, $festival->getYear());

            $mediaResults = $mediaResults['items'];
            $this->filterMedias($mediaResults);

            $items = array(
                'news'       => $this->mergeNews($newsResults['items'], $infoResults['items'], $statementResults['items']),
                'events'     => $eventResults['items'],
                'medias'     => $mediaResults,
                'films'      => $filmResults['items'],
            );
        }
        else {
            $items = array();
        }
        //set context view
        $groups = array('search');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }


    private function getSearchResults($locale, $type, $searchTerm, $range = 50, $page = 1, $fdcYear = 2016)
    {
        /** var FOS\ElasticaBundle\Manager\RepositoryManager */
        $repositoryManager = $this->container->get('fos_elastica.manager');

        // Get the events.
        /** var FOS\ElasticaBundle\Repository */
        $repository = $repositoryManager->getRepository('BaseCoreBundle:' . self::$entityMapper[$type]);

        /** var array of Acme\UserBundle\Entity\User */
        return $repository->findWithCustomQuery($locale, $searchTerm, $range, $page, $fdcYear);
    }

    private function filterMedias(&$medias)
    {
        foreach ($medias as $key => $media) {
            if ($media instanceof MediaAudio) {
                unset($medias[$key]);
            }
        }
        $medias = array_values($medias);
    }

    private function mergeNews($news, $infos, $statements)
    {
        $output = array();

        foreach ($news as $item) {
            if ($item->getPublishedAt()) {
                $key = $item->getPublishedAt()->getTimestamp() . '-news-' . $item->getId();
                $output[$key] = $item;
            }
        }

        foreach ($infos as $item) {
            if ($item->getPublishedAt()) {
                $key = $item->getPublishedAt()->getTimestamp() . '-infos-' . $item->getId();
                $output[$key] = $item;
            }
        }

        foreach ($statements as $item) {
            if ($item->getPublishedAt()) {
                $key = $item->getPublishedAt()->getTimestamp() . '-statements-' . $item->getId();
                $output[$key] = $item;
            }
        }

        krsort($output);

        return array_values($output);
    }

}
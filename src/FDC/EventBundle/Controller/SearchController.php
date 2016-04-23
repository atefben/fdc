<?php

namespace FDC\EventBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use FDC\EventBundle\Form\Type\SearchType;

/**
 * @Route("/")
 * 
 * @return JsonResponse
 */
class SearchController extends Controller 
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
     *
     * @Route("/search/ajax/{searchFilter}/{searchTerm}")
     * @param Request $request
     * @param $searchTerm
     * @return array
     */
    public function searchAjaxAction($_locale, $searchFilter, $searchTerm = null) 
    {
        $searchResults = $this->getSearchResults($_locale, $searchFilter, $searchTerm);
        
        return $this->render("FDCEventBundle:Search:{$searchFilter}.html.twig", array(
          'items' => $searchResults['items'],
          'searchFilters' => $this->getSearchFilters($searchFilter, $searchResults['items']),
        ));
    }
    
    /**
     * @Route("/search/{searchTerm}", options={"expose"=true})
     * @Template("FDCEventBundle:Global:search.page.html.twig")
     * @param $searchTerm
     * @param null $resultFilter
     * @return array
     */
    public function searchSubmitAction($_locale, $searchTerm, $resultFilter = null) 
    {
      $this->searchAutocompleteAction($_locale, $searchTerm);
      
      $newsResults = $this->getSearchResults($_locale, 'news', $searchTerm, 4);
      $infoResults = $this->getSearchResults($_locale, 'info', $searchTerm, 4);
      $statementResults = $this->getSearchResults($_locale, 'statement', $searchTerm, 2);
      $eventResults = $this->getSearchResults($_locale, 'event', $searchTerm, 2);
      $mediaResults = $this->getSearchResults($_locale, 'media', $searchTerm, 2);
      $participateResults = $this->getSearchResults($_locale, 'participate', $searchTerm, 2);
      $filmResults = $this->getSearchResults($_locale, 'film', $searchTerm, 4);
      $artistResults = $this->getSearchResults($_locale, 'artist', $searchTerm, 4);
      
      $result = array(
          'category' => array(
              'actualite' => $newsResults['items'],
              'artist' => $artistResults['items'],
              'film' => $filmResults['items'],
              'info' => $infoResults['items'],
              'statement' => $statementResults['items'],
              'media' => $mediaResults['items'],
              'event' => $eventResults['items'],
              'participate' => $participateResults['items'],
          ),
          'count' => array(
              'actualite' => $newsResults['count'],
              'artist' => $artistResults['count'],
              'film' => $filmResults['count'],
              'info' => $infoResults['count'],
              'statement' => $statementResults['count'],
              'media' => $mediaResults['count'],
              'event' => $eventResults['count'],
              'participate' => $participateResults['count'],
          ),
      );
        
        if ($resultFilter == null) {
            $searchResult = $result;
        } else {
            $searchResult = $result[$resultFilter];
        }

        return array(
            'searchResult' => $searchResult,
            'searchTerm' => $searchTerm
        );
    }
    
    /**
     * @Route("/searchautocomplete/{searchTerm}", options={"expose"=true})
     * @param $searchTerm
     * @return JsonResponse
     */
    public function searchAutocompleteAction($_locale, $searchTerm = null)
    {
        if ($searchTerm === null) {
            throw $this->createNotFoundException();
        }

        $repository = $this->get('base.search.repository');
        
        // Get theme query.
        $themePath = 'theme.translations';
        $themeFields = array('name');
        
        $themeQuery = $repository->getFieldsKeywordNestedQuery($themeFields, $searchTerm, $themePath, $_locale);
        
        // Get webtv query.
        $webTvPath = 'webTv.translations';
        $webTvFields = array('name');
        
        $webTvQuery = $repository->getFieldsKeywordNestedQuery($webTvFields, $searchTerm, $webTvPath, $_locale);
        
        // Get translations query.
        $translationsPath = 'translations';
        $translationsFields = array(
          'title',
          'legend',
          'introduction',
          'content',
          'profession',
        );
        
        $translationsQuery = $repository->getFieldsKeywordNestedQuery($translationsFields, $searchTerm, $translationsPath, $_locale);
        
        // Get untranslated fields query.
        $fields = array(
          'firstname',
          'lastname',
          'nationality',
          'selectionSection'
        );
 
        $fieldsQuery = $repository->getFieldsKeywordQuery($fields, $searchTerm, false);
        
        // Film Presons Query
        $filmPersonsFields = array('persons.name');
        $filmPersonsQuery = $repository->getFieldsKeywordQuery($filmPersonsFields, $searchTerm);
        
        
        // Get film country Query
        $filmCountryPath = 'countries.country.translations';
        $filmCountryFields = array('name');
        
        $filmCountryQuery = $repository->getFieldsKeywordNestedQuery($filmCountryFields, $searchTerm, $filmCountryPath, $_locale);
          
        // Get final query.
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($themeQuery)
            ->addShould($translationsQuery)
            ->addShould($fieldsQuery)
            ->addShould($filmCountryQuery)
            ->addShould($filmPersonsQuery)
            ->addShould($repository->getTagsQuery($_locale, $searchTerm))
            ->addShould($webTvQuery)
        ;
        
        // Add published query.
        $publishedQuery = $repository->getStatusFilterQuery($_locale);
        
        $filteredQuery = new \Elastica\Query\BoolQuery();
        $filteredQuery
            ->addMust($publishedQuery)
            ->addMust($finalQuery)
        ;
        
        $paginatedResults = $repository->getPaginatedResults($filteredQuery, 10, 1);
        
        foreach ($paginatedResults as $result) {
          $response[] = (object) array(
            'type' => $this->renderView("FDCEventBundle:Search:components/type.html.twig", array('object' => $result)),
            'name' => $this->renderView("FDCEventBundle:Search:components/name.html.twig", array('object' => $result)),
            'link' => $this->renderView("FDCEventBundle:Search:components/link.html.twig", array('object' => $result)),
          );
        }
        
        return new JsonResponse($response);
    }
    
    
    private function getSearchResults($_locale, $type, $searchTerm, $range = 50, $page = 1)
    {
        /** var FOS\ElasticaBundle\Manager\RepositoryManager */
        $repositoryManager = $this->container->get('fos_elastica.manager');

        // Get the events.
        /** var FOS\ElasticaBundle\Repository */
        $repository = $repositoryManager->getRepository('BaseCoreBundle:' . self::$entityMapper[$type]);

        /** var array of Acme\UserBundle\Entity\User */
        return $repository->findWithCustomQuery($_locale, $searchTerm, $range, $page);
    }
    
    private function getSearchFilters($type, $items) 
    {
        if (!count($items)) {
            return FALSE;
        }
      
        switch ($type) {
          case 'info':
            $objectTypes = \Base\CoreBundle\Entity\Info::getTypes();
            break;
          case 'statement':
            $objectTypes = \Base\CoreBundle\Entity\Statement::getTypes();
            break;
          case 'news':
            $objectTypes = \Base\CoreBundle\Entity\News::getTypes();
            break;
          case 'media':
            $objectTypes = array(
              'audio' => 'audio',
              'video' => 'video',
              'photo' => 'photo',
              'article' => 'article',
            );
            break;
          default:
            return FALSE;
        }
        
        
        $filters = array();

        foreach ($objectTypes as $objectType) {
            $filters['format'][] = array(
              'name' => $objectType,
              'slug' => $objectType,
            );
        }

        $years = array();
        $themes = array();

        foreach ($items as $item) {

            if (!in_array($item->getPublishedAt()->format('Y'), $years)) {
                $filters['date'][]['publishedAt'] = $item->getPublishedAt()->format('Y');

                $years[] = $item->getPublishedAt()->format('Y');
            }
            if (!in_array($item->getTheme()->getSlug(), $themes)) {
                $filters['theme'][] = array(
                  'slug' => $item->getTheme()->getSlug(),
                  'name' => $item->getTheme()->getName(),
                );

                $themes[] = $item->getTheme()->getSlug();
            }
        }
        
        return $filters;
    }

}

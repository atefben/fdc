<?php

namespace FDC\EventMobileBundle\Controller;

use FDC\EventMobileBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use FDC\EventMobileBundle\Form\Type\SearchType;

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
        $searchResults = $this->getSearchResults($_locale, $searchFilter, $searchTerm, 50, 1, $this->container->getParameter('fdc_year'));

        return $this->render("@FDCEventMobile/Global/search-ajax.html.twig", array(
          'items' => $searchResults['items'],
          'searchFilter' => $searchFilter,
          'searchTerm' => $searchTerm,
          'searchFilters' => $this->getSearchFilters($searchFilter, $searchResults['items']),
        ));
    }
    
    /**
     * @Route("/search/{searchTerm}", options={"expose"=true})
     * @Template("FDCEventMobileBundle:Global:search.page.html.twig")
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
      $filmResults = $this->getSearchResults($_locale, 'film', $searchTerm, 4, 1, $this->container->getParameter('fdc_year'));
      $artistResults = $this->getSearchResults($_locale, 'artist', $searchTerm, 6, 1, $this->container->getParameter('fdc_year'));
      
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
        
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($this->getFilmQuery($repository, $searchTerm, $_locale))
            ->addShould($this->getContentQuery($repository, $searchTerm, $_locale))
            ->addShould($this->getArtistQuery($repository, $searchTerm, $_locale))
        ;
        
        $paginatedResults = $repository->getPaginatedResults($finalQuery, 10, 1);
        
        $response = array();
        foreach ($paginatedResults as $result) {
          $response[] = (object) array(
            'type' => $this->renderView("FDCEventMobileBundle:Search:components/type.html.twig", array('object' => $result)),
            'name' => $this->renderView("FDCEventMobileBundle:Search:components/name.html.twig", array('object' => $result)),
            'link' => $this->renderView("FDCEventMobileBundle:Search:components/link.html.twig", array('object' => $result)),
          );
        }
        
        return new JsonResponse($response);
    }
    
    
    private function getSearchResults($_locale, $type, $searchTerm, $range = 50, $page = 1, $fdcYear = 2016)
    {
        /** var FOS\ElasticaBundle\Manager\RepositoryManager */
        $repositoryManager = $this->container->get('fos_elastica.manager');

        // Get the events.
        /** var FOS\ElasticaBundle\Repository */
        $repository = $repositoryManager->getRepository('BaseCoreBundle:' . self::$entityMapper[$type]);

        /** var array of Acme\UserBundle\Entity\User */
        return $repository->findWithCustomQuery($_locale, $searchTerm, $range, $page, $fdcYear);
    }
    
    private function getSearchFilters($type, $items) 
    {
        if (!count($items) || !in_array($type, array('info', 'statement', 'news', 'media'))) {
            return FALSE;
        }
        
        $filters = array();

        $dates = array();
        $themes = array();
        $formats = array();
        
        foreach ($items as $item) {
            if ($item->getPublishedAt() && !in_array($item->getPublishedAt()->format('dmY'), $dates)) {
                $sortedDates[] = $item->getPublishedAt();

                $dates[] = $item->getPublishedAt()->format('dmY');
            }
            if ($item->getTheme() && !in_array($item->getTheme()->getSlug(), $themes)) {
                $filters['theme'][] = $item->getTheme();

                $themes[] = $item->getTheme()->getSlug();
            }
            
            $format = $this->getItemFormat($item);
            if (!in_array($format, $formats)) {
                $filters['format'][] = array('name' => $format, 'slug' => $format);

                $formats[] = $format;
            }
        }
        
        rsort($sortedDates);
        $filters['date'] = $sortedDates;
        
        return $filters;
    }

    private function getItemFormat($item)
    {
      $reflect = new \ReflectionClass(get_class($item));
      $class = $reflect->getShortName();
      
      return strtolower(strtr($class, array('Image' => 'Photo','Info' => '', 'Media' => '', 'Statement' => '', 'News' => '')));
    }
    
    private function getContentQuery($repository, $searchTerm, $_locale)
    {
      // Get theme query.
      $themePath = 'theme.translations';
      $themeFields = array('theme.translations.name');

      $themeQuery = $repository->getFieldsKeywordNestedQuery($themeFields, $searchTerm, $themePath, $_locale);
      
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
      
      // Web TV query (for media)
      $webTvPath = 'webTv.translations';
      $webTvFields = array('name');

      $webTvQuery = $repository->getFieldsKeywordNestedQuery($webTvFields, $searchTerm, $webTvPath, $_locale);
      
      // Participate sections query.
      $participateSectionsPath = 'downloadSection.section.translations';
      $participateSectionsFields = array(
          'downloadSection.section.translations.title', 
          'downloadSection.section.translations.description'
      );
      $participateSectionsQuery = $repository->getFieldsKeywordNestedQuery($participateSectionsFields, $searchTerm, $participateSectionsPath, $_locale);

      // Get final query.
      $allQuery = new \Elastica\Query\BoolQuery();
      $allQuery
          ->addShould($themeQuery)
          ->addShould($translationsQuery)
          ->addShould($repository->getTagsQuery($_locale, $searchTerm))
          ->addShould($webTvQuery)
          ->addShould($participateSectionsQuery)
      ;
      
      // Filter out film and person.
      $typeFilmFilter = new \Elastica\Filter\Type('film');
      $typeArtistFilter = new \Elastica\Filter\Type('artist');
      
      $filterOutFilm = new \Elastica\Filter\BoolNot($typeFilmFilter);
      $filterOutArtist = new \Elastica\Filter\BoolNot($typeArtistFilter);
      
      $typeFilterOut = new \Elastica\Filter\BoolFilter();
      $typeFilterOut
          ->addMust($filterOutFilm)
          ->addMust($filterOutArtist)
      ;
        
      $filtered = new \Elastica\Query\Filtered($allQuery, $typeFilterOut);
      
      // Add published query.
      $publishedQuery = $repository->getStatusFilterQuery($_locale);

      $filteredQuery = new \Elastica\Query\BoolQuery();
      $filteredQuery
          ->addMust($publishedQuery)
          ->addMust($filtered)
      ;
      
      return $filteredQuery;
    }
    
    private function getArtistQuery($repository, $searchTerm, $_locale)
    {
      // Get untranslated fields query.
        $artistFields = array(
          'firstname',
          'lastname',
          'nationality',
        );
 
        $artistQuery = $repository->getFieldsKeywordQuery($artistFields, $searchTerm, false);
        
        // Search for movie.
        $path = 'films.film.translations';
        $fields = array('films.film.translations.title');
        $keywordMatchQuery = $repository->getFieldsKeywordNestedQuery($fields, $searchTerm, $path, $_locale);
        
        // Get only movies from FDC current year.
        $yearQuery = $repository->getFieldsKeywordQuery('films.film.productionYear', $this->container->getParameter('fdc_year'));
        
        $keywordNestedQuery = new \Elastica\Query\Nested();
        $keywordNestedQuery
            ->setQuery($yearQuery)
            ->setPath('films')
        ;
        
        $filmQuery = new \Elastica\Query\BoolQuery();
        $filmQuery
            ->addMust($keywordNestedQuery)
            ->addMust($keywordMatchQuery)
        ;
        
        $finalQuery = new \Elastica\Query\BoolQuery();
        $finalQuery
            ->addShould($filmQuery)
            ->addShould($artistQuery)
        ;
        
        return $finalQuery;
    }
    
    private function getFilmQuery($repository, $searchTerm, $_locale)
    {
        // Get translations query.
        $translationsPath = 'translations';
        $translationsFields = array(
          'title',
        );
        
        $translationsQuery = $repository->getFieldsKeywordNestedQuery($translationsFields, $searchTerm, $translationsPath, $_locale);
        
        // Get untranslated fields query.
        $fields = array(
          'selectionSection',
          'titleVO'
        );
 
        $fieldsQuery = $repository->getFieldsKeywordQuery($fields, $searchTerm, false);
        
        // Film Presons Query
        $filmPersonsFields = array('persons.name');
        $filmPersonsQuery = $repository->getFieldsKeywordQuery($filmPersonsFields, $searchTerm);
        
        
        // Get film country Query
        $filmCountryPath = 'countries.country.translations';
        $filmCountryFields = array('name');
        
        $filmCountryQuery = $repository->getFieldsKeywordNestedQuery($filmCountryFields, $searchTerm, $filmCountryPath, $_locale);
          
        // Get film Query with year.
        $productionYearQuery = $repository->getFieldsKeywordQuery(array('productionYear'), $this->container->getParameter('fdc_year'));
        
        
        // Artist query.
        $artistQuery = $repository->getFieldsKeywordQuery(array('persons.name'), $searchTerm);
        
        $filmQuery = new \Elastica\Query\BoolQuery();
        $filmQuery
            ->addShould($translationsQuery)
            ->addShould($fieldsQuery)
            ->addShould($filmPersonsQuery)
            ->addShould($filmCountryQuery)
            ->addShould($artistQuery)
        ;
        
        $filmFinalQuery = new \Elastica\Query\BoolQuery();
        $filmFinalQuery
            ->addMust($filmQuery)
            ->addMust($productionYearQuery)
        ;
      
        return $filmFinalQuery;
    }
}

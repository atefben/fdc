<?php

namespace FDC\CorporateBundle\Controller;

use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use FDC\CorporateBundle\Form\Type\SearchType;

/**
 * @Route("/")
 *
 * @return JsonResponse
 */
class SearchController extends Controller
{
    private static $entityMapper = array(
        'news'        => 'News',
        'info'        => 'Info',
        'statement'   => 'Statement',
        'photos'      => 'MediaImage',
        'videos'      => 'MediaVideo',
        'audios'      => 'MediaAudio',
        'event'       => 'Event',
        'artist'      => 'FilmPerson',
        'film'        => 'FilmFilm'
    );

    /**
     *
     * @Route("/search/{searchFilter}")
     * @param Request $request
     * @param $searchTerm
     * @return array
     */
    public function searchFilterAction($_locale, $searchFilter, Request $request)
    {
        $data = $request->query->all();

        $filters = explode('_', $searchFilter);

        $searchResults = array('items' => array(), 'count' => 0);
        foreach($filters as $filter) {
            $results = $this->getSearchResults($_locale, $filter, $data, 50, 1);
            $searchResults['items'] = array_merge($searchResults['items'], $results['items']);
            $searchResults['count'] = $searchResults['count'] + $results['count'];
        }

        return $this->render("FDCCorporateBundle:Search:result_more.html.twig", array(
            'result' => array($searchFilter => $searchResults)
            //'searchFilters' => $this->getSearchFilters($searchFilter, $searchResults['items']),
        ));
    }

    /**
     * @Route("/search", options={"expose"=true})
     */
    public function searchSubmitAction($_locale, Request $request)
    {
        $translator = $this->get('translator');

        $professions = array(
            'search.form.jobs.director' => array(
                'Réalisa(teur/trice)',
                'Réalisatrice, Société des Réalisateurs de Films - SRF',
                'Réalisateur, scénariste',
                'Réalisatrice',
                'Comédien, Réalisateur',
                'Acteur, Réalisateur, Producteur',
                'Réalisatrice, écrivain',
                'Réalisateur, Scénariste, Producteur',
                'Acteur, Réalisateur',
                'Réalisateur, auteur dramatique, écrivain',
                'Réalisa(teur/trice), Scénariste, Produc(teur/trice)',
                'Premi(er/ière) assistant(e) réalisa(teur/trice)',
                'Actrice, Réalisatrice',
                'Assistant(e) réalisa(teur/trice)',
                'Ac(teur/trice), Réalisa(teur/trice)',
                'Auteur, Réalisatrice',
                'Société des Réalisateurs de Films'
            ),
            'search.form.jobs.actor' => array(
                'Acteur',
                'Actrice',
                'Acteur, Réalisateur, Producteur',
                'Acteur, Réalisateur',
                'Actrice, Réalisatrice',
                'Cinéaste, Actrice'
            ),
            'search.form.jobs.writer' => array(
                'Scénariste',
                'Scénario / Dialogues',
                'Réalisateur, Scénariste, Producteur',
                'Réalisa(teur/trice), Scénariste, Produc(teur/trice)',
                'Scénariste',
            ),
            'search.form.jobs.producer' => array(
                'Produc(teur/trice) exécutif',
                'Co-Produc(teur/trice)',
                'Acteur, Réalisateur, Producteur',
                'Produc(teur/trice)',
                'Producteur exécutif',
                'Administration de production',
                'Autres - Equipe production',
                'Réalisateur, Scénariste, Producteur',
                'Réalisa(teur/trice), Scénariste, Produc(teur/trice)',
                'Producteur exécutif',
                'Productrice',
                'Producteur',
                'Producteur, distributeur, exploitant',
            ),
            'search.form.jobs.distributor' => array(
                'Distribu(teur/trice)',
                'Producteur, distributeur, exploitant'
            ),
            'search.form.jobs.composer' => array(
                'Composi(teur/trice) de musique de films',
                'Auteur, Compositeur, Interprète'
            ),
            'search.form.jobs.operator' => array(
                'Chef opérateur',
                'Chef opérateur / direc(teur/trice) photo'
            )
        );

        //creating table for checkboxes keys and values
        //array('director' => 'search.form.jobs.director', etc.
        $professionsCheckBoxes = array();
        foreach($professions as $label => $profession) {
            $text = explode('.', $label);
            $text = $text[count($text)-1];
            $professionsCheckBoxes[$label] = $text;
        }



        $prizesCheckboxes = array(
            $translator->trans('search.form.prize.palmedor', array(), 'FDCCorporateBundle') =>  $translator->trans('search.form.prize.palmedor', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.grandprix', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.grandprix', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.miseenscene', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.miseenscene', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.scenario', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.scenario', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.interpretefeminine', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.interpretefeminine', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.interpretemasculine', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.interpretemasculine', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.jury', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.jury', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.palmedorcourtmetrage', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.palmedorcourtmetrage', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.uncertainregard', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.uncertainregard', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.groupamagan', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.groupamagan', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.cinefondation', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.cinefondation', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.prize.camerador', array(), 'FDCCorporateBundle') => $translator->trans('search.form.prize.camerador', array(), 'FDCCorporateBundle')
        );

        $selectionsCheckboxes = array(
            $translator->trans('search.form.selection.competition', array(), 'FDCCorporateBundle') =>  $translator->trans('search.form.selection.competition', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.uncertainregard', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.uncertainregard', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.horscompetition', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.horscompetition', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.seancesspeciales', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.seancesspeciales', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.courtmetrage', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.courtmetrage', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.cinefondation', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.cinefondation', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.invitedhonneur', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.invitedhonneur', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.hommages', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.hommages', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.copiesrestaurees', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.copiesrestaurees', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.worldcinemaproject', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.worldcinemaproject', array(), 'FDCCorporateBundle'),
            $translator->trans('search.form.selection.documentaires', array(), 'FDCCorporateBundle') => $translator->trans('search.form.selection.documentaires', array(), 'FDCCorporateBundle')
        );

        $searchForm = $this->createForm(new SearchType($translator, '', $professionsCheckBoxes, $prizesCheckboxes, $selectionsCheckboxes));

        /*$em = $this->get('doctrine')->getManager();
        $professions = $em->createQueryBuilder()->select('fpt')
            ->from('BaseCoreBundle:FilmPrizeTranslation', 'fpt')
            ->where('fpt.locale = :locale')
            ->setParameter('locale', $_locale)
            ->distinct()
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();*/

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $data = $searchForm->getData();

            $newsResults = $data['news'] ? $this->getSearchResults($_locale, 'news', $data, 4) : false;
            $infoResults = $data['news'] ? $this->getSearchResults($_locale, 'info', $data, 4) : false;
            $statementResults = $data['news'] ? $this->getSearchResults($_locale, 'statement', $data, 4) : false;
            $eventResults = $data['events'] ? $this->getSearchResults($_locale, 'event', $data, 5) : false;

            if($data['news']) {
                $infoStatementsResults = array();
                $infoStatementsResults['items'] = array_merge($infoResults['items'], $statementResults['items']);
                $infoStatementsResults['count'] = $infoResults['count'] + $infoResults['count'];
            } else {
                $infoStatementsResults = false;
            }

            if($data['photos'] || $data['videos'] || $data['audios']) {
                //$mediaResults = $data['photos'] ? $this->getSearchResults($_locale, 'media', $data, 2) : false;
                //$photoResults = $data['photos'] ? $this->getSearchResults($_locale, 'photo', $data, 2) : false;
                //$videoResults = $data['videos'] ? $this->getSearchResults($_locale, 'video', $data, 2) : false;
                //$audioResults = $data['audios'] ? $this->getSearchResults($_locale, 'audio', $data, 2) : false;

                //merging medias (photos,videos,audios)
                //$mediaResults = array_merge($photoResults, $videoResults);
                //$mediaResults = array_merge($mediaResults, $audioResults);
            }

            $filmResults = $data['movies'] ? $this->getSearchResults($_locale, 'film', $data, 5, 1) : false;

            if($data['professions']) {
                $professionLabels = array();
                //for each profession checked, add every label linked to this profession
                foreach($data['professions'] as $profession) {
                    foreach($professions['search.form.jobs.'.$profession] as $label) {
                        $professionLabels[] = $label;
                    }
                }
                $data['professions'] = $professionLabels;
            }


            $artistResults = $data['artists'] ? $this->getSearchResults($_locale, 'artist', $data, 5, 1) : false;

            $result = array(
                'news' => $newsResults,
                'artist' => $artistResults,
                'film' => $filmResults,
                'info_statement' => $infoStatementsResults,
                //'media' => $mediaResults,
                'event' => $eventResults,
            );

            return $this->render('FDCCorporateBundle:Search:result.html.twig', array(
                'result' => $result,
                //'searchTerm' => $data['search'],
                'form' => $searchForm->createView()
            ));
        } else {
            return $this->render('FDCCorporateBundle:Search:search.html.twig', array(
                'form' => $searchForm->createView()
            ));
        }

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
                'type' => $this->renderView("FDCEventBundle:Search:components/type.html.twig", array('object' => $result)),
                'name' => $this->renderView("FDCEventBundle:Search:components/name.html.twig", array('object' => $result)),
                'link' => $this->renderView("FDCEventBundle:Search:components/link.html.twig", array('object' => $result)),
            );
        }

        return new JsonResponse($response);
    }


    private function getSearchResults($_locale, $type, $data, $range = 50, $page = 1)
    {
        /** var FOS\ElasticaBundle\Manager\RepositoryManager */
        $repositoryManager = $this->container->get('fos_elastica.manager');

        // Get the events.
        /** var FOS\ElasticaBundle\Repositorchary */
        $repository = $repositoryManager->getRepository('BaseCoreBundle:' . self::$entityMapper[$type]);

        /** var array of Acme\UserBundle\Entity\User */

        return $repository->findWithCustomQuery($_locale, $data, $range, $page);
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
            if (!in_array($item->getPublishedAt()->format('dmY'), $dates)) {
                $sortedDates[] = $item->getPublishedAt();

                $dates[] = $item->getPublishedAt()->format('dmY');
            }
            if (!in_array($item->getTheme()->getSlug(), $themes)) {
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
        $yearQuery = $repository->getFieldsKeywordQuery('films.film.festival.year', $this->container->getParameter('fdc_year'));

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
        $productionYearQuery = $repository->getFieldsKeywordQuery(array('festival.year'), $this->container->getParameter('fdc_year'));

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

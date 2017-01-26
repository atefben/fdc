<?php

namespace FDC\CorporateBundle\Controller;

use Elastica\Query;
use Elastica\Query\QueryString;
use FDC\CorporateBundle\Form\Type\SearchType;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 * @return JsonResponse
 */
class SearchController extends Controller
{
    private static $entityMapper = array(
        'news'      => 'News',
        'info'      => 'Info',
        'statement' => 'Statement',
        'photos'    => 'MediaImage',
        'videos'    => 'MediaVideo',
        'audios'    => 'MediaAudio',
        'event'     => 'Event',
        'artist'    => 'FilmPerson',
        'film'      => 'FilmFilm',
    );

    /**
     * @Route("/search", options={"expose"=true})
     * @param $_locale
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchSubmitAction($_locale, Request $request)
    {
        $page = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:CorpoSearch')->find(1);

        $searchForm = $this->_getFormFilters();
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $data = $searchForm->getData();

            //if none checked, check all
            $hasCheckedItem = false;
            foreach ($data as $filter) {
                $hasCheckedItem = $hasCheckedItem ?: $filter === true;
            }
            if (!$hasCheckedItem) {
                foreach ($data as &$filter) {
                    if (is_bool($filter)) {
                        $filter = !$filter;
                    }
                }
            }

            $filters = $this->_getFiltersFromData($data);

            if ($data['professions']) { //must be done before translation
                $data['professions'] = $this->_getLinkedProfessions($data['professions']);
            }

            $data = $this->_translateData($data);
            $newsResults = $data['news'] ? $this->getSearchResults($_locale, 'news', $data, 4) : false;
            $infoResults = $data['news'] ? $this->getSearchResults($_locale, 'info', $data, 4) : false;
            $statementResults = $data['news'] ? $this->getSearchResults($_locale, 'statement', $data, 4) : false;
            $eventResults = $data['events'] ? $this->getSearchResults($_locale, 'event', $data, 4) : false;

            if ($data['news']) {
                $infoStatementsResults = array();
                $infoStatementsResults['items'] = array_merge($infoResults['items'], $statementResults['items']);
                $infoStatementsResults['count'] = $infoResults['count'] + $statementResults['count'];

                //may have too many (4 infos + 4 statements). reduce to 4 items
                if (count($infoStatementsResults['items']) > 4) {
                    for ($i = count($infoStatementsResults['items']) - 1; $i >= 4; $i--) {
                        unset($infoStatementsResults['items'][$i]);
                    }
                }
            } else {
                $infoStatementsResults = false;
            }

            if ($data['photos'] || $data['videos'] || $data['audios']) {

                $i = 0;
                if ($data['photos'])
                    $i += 1;
                if ($data['videos'])
                    $i += 1;
                if ($data['audios'])
                    $i += 1;

                $displayNb = 4;
                switch ($i) {
                    case 1:
                        $displayNb = 4;
                        break;
                    case 2:
                        $displayNb = 3;
                        break;
                    case 3:
                        $displayNb = 2;
                        break;
                }

                $default = ['items' => [], 'count' => 0];
                $photoResults = $data['photos'] ? $this->getSearchResults($_locale, 'photos', $data, $displayNb) : $default;
                $videoResults = $data['videos'] ? $this->getSearchResults($_locale, 'videos', $data, $displayNb) : $default;
                $audioResults = $data['audios'] ? $this->getSearchResults($_locale, 'audios', $data, $displayNb) : $default;
                $items = array_merge($photoResults['items'], $videoResults['items'], $audioResults['items']);
                $count = $photoResults['count'] + $videoResults['count'] + $audioResults['count'];
                $mediaResults = array('items' => array_slice($items, 0, 4), 'count' => $count);
            } else {
                $mediaResults = false;
            }
            $filmResults = $data['movies'] ? $this->getSearchResults($_locale, 'film', $data, 5, 1) : false;
            $artistResults = $data['artists'] ? $this->getSearchResults($_locale, 'artist', $data, 5, 1) : false;

            $result = array(
                'news'           => $newsResults,
                'artist'         => $artistResults,
                'film'           => $filmResults,
                'info_statement' => $infoStatementsResults,
                'media'          => $mediaResults,
                'event'          => $eventResults,
            );

            return $this->render('FDCCorporateBundle:Search:result.html.twig', array(
                'result'  => $result,
                'filters' => $filters,
                'form'    => $searchForm->createView(),
                'page'    => $page,
            ));
        } else {
            return $this->render('FDCCorporateBundle:Search:search.html.twig', array(
                'form' => $searchForm->createView(),
                'page' => $page,
            ));
        }

    }

    /**
     * @Route("/search/{searchFilter}")
     * @param $_locale
     * @param $searchFilter
     * @param Request $request
     * @return Response
     */
    public function searchFilterAction($_locale, $searchFilter, Request $request)
    {
        $page = $this->get('doctrine')->getManager()->getRepository('BaseCoreBundle:CorpoSearch')->find(1);
        $form = $this->_getFormFilters();
        $form = $form->handleRequest($request);

        $items = explode('_', $searchFilter != 'media' ? $searchFilter : 'photos_videos_audios');
        $searchResults = array('items' => array(), 'count' => 0);
        foreach ($items as $item) {
            if ($item == 'artist' && isset($data['professions'])) {
                $data['professions'] = $this->_getLinkedProfessions($data['professions']);
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            //if none checked, check all
            $hasCheckedItem = false;
            foreach ($data as $filter) {
                $hasCheckedItem = $hasCheckedItem ?: $filter === true;
            }
            if (!$hasCheckedItem) {
                foreach ($data as &$filter) {
                    if (is_bool($filter)) {
                        $filter = !$filter;
                    }
                }
            }

            $filters = $this->_getFiltersFromData($data);

            if ($data['professions']) { //must be done before translation
                $data['professions'] = $this->_getLinkedProfessions($data['professions']);
            }

            $data = $this->_translateData($data);
        }

        $check = ['audios', 'videos', 'photos'];
        foreach ($items as $item) {
            if (in_array($item, $check)) {
                if (!$data[$item]) {
                    continue;
                }
            }
            $data = $this->_translateData($data);
            $results = ['items' => [], 'count' => 0];
            $page = 1;
            while ($page && $subResults = $this->getSearchResults($_locale, $item, $data, 50, $page)) {
                $results['items'] = array_merge($results['items'], $subResults['items']);
                $results['count'] = $subResults['count'];
                ++$page;
                $pages = ceil($results['count'] / 50);
                if ($page > $pages) {
                    $page = false;
                }
            }
            $searchResults['items'] = array_merge($searchResults['items'], $results['items']);
            $searchResults['count'] = $searchResults['count'] + $results['count'];
        }

        return $this->render("FDCCorporateBundle:Search:result_more.html.twig", array(
            'result'  => array($searchFilter => $searchResults),
            'filters' => $filters,
            'form'    => $form->createView(),
            'page'    => $page,
        ));
    }

    //get linked labels for each profession
    private function _getProfessionsTab()
    {
        return array(
            'search.form.director'    => array(
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
                'Société des Réalisateurs de Films',
            ),
            'search.form.actor'       => array(
                'Acteur',
                'Actrice',
                'Acteur, Réalisateur, Producteur',
                'Acteur, Réalisateur',
                'Actrice, Réalisatrice',
                'Cinéaste, Actrice',
            ),
            'search.form.writer'      => array(
                'Scénariste',
                'Scénario / Dialogues',
                'Réalisateur, Scénariste, Producteur',
                'Réalisa(teur/trice), Scénariste, Produc(teur/trice)',
                'Scénariste',
            ),
            'search.form.producer'    => array(
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
            'search.form.distributor' => array(
                'Distribu(teur/trice)',
                'Producteur, distributeur, exploitant',
            ),
            'search.form.composer'    => array(
                'Composi(teur/trice) de musique de films',
                'Auteur, Compositeur, Interprète',
            ),
            'search.form.operator'    => array(
                'Chef opérateur',
                'Chef opérateur / direc(teur/trice) photo',
            ),
        );
    }

    //returns a table with each labels linked to professions in array arg
    private function _getLinkedProfessions($professions)
    {
        $professionsLink = $this->_getProfessionsTab();
        $professionLabels = array();
        //for each profession, get every label linked to this profession
        foreach ($professions as $profession) {
            foreach ($professionsLink['search.form.' . $profession] as $label) {
                $professionLabels[] = $label;
            }
        }

        return $professionLabels;
    }

    //receive form data and returns a table of filters labels
    private function _getFiltersFromData($data)
    {
        $translator = $this->get('translator');
        $filters = array();

        $boolean = ['news', 'photos', 'videos', 'audios', 'events', 'artists', 'movies'];
        foreach ($data as $key => &$filter) {
            if ((in_array($key, $boolean) || is_bool($filter)) && $filter) {
                /** @Ignore */
                $filters[$key] = $translator->trans('search.form.' . $key, array(), 'FDCCorporateBundle');
            } elseif (is_numeric($filter)) {
                //don't add year-start and year-end
            } elseif (is_string($filter) && !empty($filter)) {
                $filters[$key] = $filter;
            } elseif (is_array($filter)) {
                if ($key == 'professions') {
                    foreach ($filter as $f) {
                        $subKey = $key . '_' . $f;
                        $f = $translator->trans('search.form.' . $f, array(), 'FDCCorporateBundle');
                        $filters[$subKey] = $f;
                    }

                } else {
                    foreach ($filter as &$f) {
                        $subKey = $key . '_' . $f;
                        $f = $translator->trans('search.form.' . $f, array(), 'FDCCorporateBundle');
                        $filters[$subKey] = $f;
                    }
                }
            }
        }

        return $filters;
    }

    private function _getFormFilters()
    {
        $translator = $this->get('translator');
        $professions = $this->_getProfessionsTab();

        //creating table for checkboxes keys and values
        //array('director' => 'search.form.jobs.director', etc.
        $professionsCheckBoxes = array();
        foreach ($professions as $label => $profession) {
            $text = explode('.', $label);
            $text = $text[count($text) - 1];
            $translatedLabel = $translator->trans($label, array(), 'FDCCorporateBundle');
            $professionsCheckBoxes[$translatedLabel] = $text;
        }


        $prizesCheckboxes = array(
            $translator->trans('search.form.palmedor', array(), 'FDCCorporateBundle')                => 'palmedor',
            $translator->trans('search.form.grandprix', array(), 'FDCCorporateBundle')               => 'grandprix',
            $translator->trans('search.form.prixmiseenscene', array(), 'FDCCorporateBundle')         => 'prixmiseenscene',
            $translator->trans('search.form.prixscenario', array(), 'FDCCorporateBundle')            => 'prixscenario',
            $translator->trans('search.form.prixinterpretefeminine', array(), 'FDCCorporateBundle')  => 'prixinterpretefeminine',
            $translator->trans('search.form.prixinterpretemasculine', array(), 'FDCCorporateBundle') => 'prixinterpretemasculine',
            $translator->trans('search.form.prixjury', array(), 'FDCCorporateBundle')                => 'prixjury',
            $translator->trans('search.form.palmedorcourtmetrage', array(), 'FDCCorporateBundle')    => 'palmedorcourtmetrage',
            $translator->trans('search.form.prixuncertainregard', array(), 'FDCCorporateBundle')     => 'prixuncertainregard',
            $translator->trans('search.form.groupamagan', array(), 'FDCCorporateBundle')             => 'groupamagan',
            $translator->trans('search.form.prixcinefondation', array(), 'FDCCorporateBundle')       => 'prixcinefondation',
            $translator->trans('search.form.camerador', array(), 'FDCCorporateBundle')               => 'camerador',
        );

        $selectionsCheckboxes = array(
            $translator->trans('search.form.competition', array(), 'FDCCorporateBundle')      => 'competition',
            $translator->trans('search.form.horscompetition', array(), 'FDCCorporateBundle')  => 'horscompetition',
            $translator->trans('search.form.seancesspeciales', array(), 'FDCCorporateBundle') => 'seancesspeciales',
            $translator->trans('search.form.uncertainregard', array(), 'FDCCorporateBundle')  => 'uncertainregard',
            $translator->trans('search.form.cannesclassics', array(), 'FDCCorporateBundle')   => 'cannesclassics',
            $translator->trans('search.form.cinefondation', array(), 'FDCCorporateBundle')    => 'cinefondation',
            $translator->trans('search.form.cinemadelaplage', array(), 'FDCCorporateBundle')    => 'cinemadelaplage',
        );

        return $this->createForm(new SearchType($translator, '', $professionsCheckBoxes, $prizesCheckboxes, $selectionsCheckboxes));
    }

    private function _translateData($data)
    {
        $translator = $this->get('translator');
        foreach ($data as &$value) {
            if (is_array($value)) {
                foreach ($value as &$label) {
                    $label = $translator->trans('search.form.' . $label, array(), 'FDCCorporateBundle');
                }
            }
        }

        return $data;
    }


    /**
     * @Route("/searchautocomplete/{searchTerm}", options={"expose"=true})
     * @param $searchTerm
     * @return JsonResponse
     */
    public function searchAutocompleteAction($_locale, $searchTerm = null)
    {

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
            $response[] = (object)array(
                'type' => $this->renderView("FDCEventBundle:Search:components/type.html.twig", array('object' => $result)),
                'name' => $this->renderView("FDCEventBundle:Search:components/name.html.twig", array('object' => $result)),
                'link' => $this->renderView("FDCEventBundle:Search:components/link.html.twig", array('object' => $result)),
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/countryautocomplete/{searchTerm}", options={"expose"=true})
     * @param $searchTerm
     * @return JsonResponse
     */
    public function countryAutocompleteAction($_locale, $searchTerm = null)
    {

        $index = $this->container->get('fos_elastica.finder.fdc.country');

        $keywordQuery = new QueryString();
        $keywordQuery->setQuery("*" . $searchTerm . "*");

        $query = new Query();
        $query->setQuery($keywordQuery);


        $response = array();
        foreach ($index->find($query) as $result) {
            $response[] = (object)array(
                'name' => $this->renderView("FDCEventBundle:Search:components/country.html.twig", array('object' => $result)),

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
            return false;
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

        return strtolower(strtr($class, array('Image' => 'Photo', 'Info' => '', 'Media' => '', 'Statement' => '', 'News' => '')));
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
            'downloadSection.section.translations.description',
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
            'titleVO',
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

    private function getCountryQuery($repository, $searchTerm, $_locale)
    {
        // Get translations query.
        $translationsPath = 'translations';
        $translationsFields = array(
            'name',
        );

        $translationsQuery = $repository->getFieldsKeywordNestedQuery($translationsFields, $searchTerm, $translationsPath, $_locale);


        $filmQuery = new \Elastica\Query\BoolQuery();
        $filmQuery
            ->addShould($translationsQuery);

        $filmFinalQuery = new \Elastica\Query\BoolQuery();
        $filmFinalQuery
            ->addMust($filmQuery);

        return $filmFinalQuery;
    }
}

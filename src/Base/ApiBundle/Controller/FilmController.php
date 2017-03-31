<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Component\Gender;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmPerson;
use Base\CoreBundle\Entity\FilmFilmPersonFunction;
use Base\CoreBundle\Entity\FilmFunctionTranslation;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * FilmController class.
 *
 * \@extends FOSRestController
 */
class FilmController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmFilm';

    /**
     * Return an array of films, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all films",
     *   section="Films",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmFilm",
     *      "groups"={"film_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     * @Rest\QueryParam(name="festival_id", description="The festival year")
     * @Rest\QueryParam(name="selection_id", description="The selection identifier")
     *
     * @param  ParamFetcher $paramFetcher
     *
     * @return View
     */
    public function getFilmsAction(ParamFetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // parameters
        $selection = $paramFetcher->get('selection_id');
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // create query
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository($this->repository)->getApiFilms($festival, $selection);

        // get items
        $items = $coreManager->getPaginationItems($query, $paramFetcher);

        foreach ($items as $item) {
            $this->translateFunction($item, $lang);
        }


        // set context view
        $groups = ['film_list'];
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->setVersion($version);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);


        return $view;
    }

    private function translateFunction(&$film, $locale)
    {
        if ($film instanceof FilmFilm) {
            $persons = $film->getPersons();
            foreach ($persons as &$person) {
                if ($person instanceof FilmFilmPerson && $person->getPerson() && $person->getPerson()->findTranslationByLocale($locale)) {
                    $functions = $person->getFunctions();
                    foreach ($functions as &$function) {
                        if ($function instanceof FilmFilmPersonFunction) {
                            $subFunction = $function->getFunction();
                            $translation = $subFunction->findTranslationByLocale($locale);
                            if ($translation instanceof FilmFunctionTranslation) {
                                $gender = $person->getPerson()->findTranslationByLocale($locale)->getGender();
                                $translation->setName(Gender::functionGenderFormatter($translation->getName(), $gender));
                            }
                            $subFunction->setTranslation($translation, $locale);
                            $function->setFunction($subFunction);
                        }
                    }
                }
            }
            $film->setPersons($persons);
        }
    }

    /**
     * Return a single film by $id, the id format is xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a film by $id",
     *  section="Films",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The film identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmFilm",
     *      "groups"={"film_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getFilmAction(ParamFetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // create query
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository($this->repository)->getApiFilm($id, $festival);

        $this->translateFunction($film, $lang);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(['film_show']);
        $context->setVersion($version);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

        // create view
        $view = $this->view($film, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single film by $id, the id format is xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
     *
     * @Rest\View()
     * @Rest\Get("/film-2017/{id}")
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a film by $id",
     *  section="Films",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The film identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmFilm",
     *      "groups"={"film_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getFilm2017Action(ParamFetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // parameters
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // get festival
        $festival = $coreManager->getApiFestivalYear();

        // create query

        $film = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmFilm')
            ->getApiFilm($id, $festival)
        ;
        $film->setApi2017(true);

        $this->translateFunction($film, $lang);

        // set context view
        $context = SerializationContext::create();
        $context->setGroups(['film_show']);
        $context->setVersion($version);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));

        // create view
        $view = $this->view($film, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}

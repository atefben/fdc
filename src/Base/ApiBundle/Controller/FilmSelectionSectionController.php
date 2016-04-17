<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use Base\ApiBundle\Component\FOSRestController;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmSelectionSection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class FilmSelectionSectionController
 * @package Base\ApiBundle\Controller
 */
class FilmSelectionSectionController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:FilmSelectionSection';

    /**
     * Return an array of film selections section , can be filtered with page / offset, film_id parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all selections sections",
     *   section="Film Selections sections",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\FilmSelectionSection",
     *      "groups"={"film_selection_section_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="film_id", description="The Film id")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getFilmSelectionSectionsAction(ParamFetcher $paramFetcher)
    {
        // core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // create query
        $queryBuilder = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository($this->repository)
            ->getApiSections($paramFetcher->get('film_id'))
        ;

        // get items
        $items = $coreManager->getPaginationItems($queryBuilder, $paramFetcher);

        // set context view
        $groups = array('film_selection_section_list');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single selection section
     *
     * @Rest\Get("/film/selection/section/{id}")
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a selection section by $id",
     *  section="Film Selections sections",
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
     *      "class"="Base\CoreBundle\Entity\FilmSelectionSection",
     *      "groups"={"film_selection_section_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     *
     * @param ParamFetcher $paramFetcher
     * @param integer $id
     * @return View
     */
    public function getFilmSelectionSectionAction(ParamFetcher $paramFetcher, $id)
    {
        // core manager shortcut
        $coreManager = $this->get('base.api.core_manager');
        $festival = $coreManager->getApiFestivalYear()->getId();

        // create query
        $selectionSection = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository($this->repository)
            ->find($id)
        ;
        $ac = new ArrayCollection();
        if ($selectionSection instanceof FilmSelectionSection) {
            foreach ($selectionSection->getFilms() as $film) {
                if ($film instanceof FilmFilm) {
                    if ($film->getFestival()->getId() === $festival) {
                        $ac->add($film);
                    }
                }
            }
            $selectionSection->setFilms($ac);
        }

        // set context view
        $groups = array('film_selection_section_show');
        $context = $coreManager->setContext($groups, $paramFetcher);

        // create view
        $view = $this->view($selectionSection, $selectionSection ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

}
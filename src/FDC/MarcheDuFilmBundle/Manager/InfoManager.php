<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfInformations;
use FDC\MarcheDuFilmBundle\Entity\MdfInformationsTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfRubriquesCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfRubrique;
use FDC\MarcheDuFilmBundle\Entity\MdfRubriqueTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestionsCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestion;
use FDC\MarcheDuFilmBundle\Entity\MdfRubriqueQuestionTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class InfoManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }
    

    public function getRubriques()
    {
        $infoPage = $this->em
            ->getRepository(MdfInformationsTranslation::class)
            ->getByLocaleAndStatus($this->requestStack->getMasterRequest()->get('_locale')
            );

        if ($infoPage) {
            $rubriquesCollectionRepo = $this->em->getRepository(MdfRubriquesCollection::class);
            $rubriqueRepo = $this->em->getRepository(MdfRubriqueTranslation::class);

            $rubriquesCollection = $rubriquesCollectionRepo
                ->getWidgetsDependingOnPostion(
                    $infoPage->getTranslatable()->getId()
                );

            if ($rubriquesCollection) {
                $rubriques = [];
                foreach ($rubriquesCollection as $widget) {
                    $rubrique = $rubriqueRepo
                        ->getRubriqueByLocaleAndTranslatableId(
                            $this->requestStack->getMasterRequest()->get('_locale'), $widget->getRubrique()
                        );

                    if ($rubrique) {
                        $rubriques[] = $rubrique;
                    }
                }
                return $rubriques;
            }
            return [];
        }
        
        return [];
    }
    
    
    public function getQuestionsAnswers($rubriques)
    {

        if ($rubriques) {
            $questionsAnswers = [];
            $questionsCollectionRepo = $this->em->getRepository(MdfRubriqueQuestionsCollection::class);
            $questionsRepo = $this->em->getRepository(MdfRubriqueQuestionTranslation::class);

            foreach ($rubriques as $widget) {
                $translatableId = $widget->getTranslatable()->getId();
                $questionsCollection = $questionsCollectionRepo
                    ->getDependingOnPositionAndRubrique($translatableId);

                if ($questionsCollection) {
                    $questionsAnswers[$translatableId] = [];

                    foreach ($questionsCollection as $item) {
                        $product = $questionsRepo
                            ->getQuestionAnswerByLocaleAndTranslatableId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $item->getRubriqueQuestion()
                            );

                        if ($product) {
                            $questionsAnswers[$translatableId][] = $product;
                        }
                    }
                }
            }
            return $questionsAnswers;
        }
        return [];
    }
}

<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmFaqPage;
use FDC\CourtMetrageBundle\Entity\CcmRubriqueQuestionsCollection;
use FDC\CourtMetrageBundle\Entity\CcmRubriqueQuestionTranslation;
use FDC\CourtMetrageBundle\Entity\CcmRubriquesCollection;
use FDC\CourtMetrageBundle\Entity\CcmRubriqueTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class FaqManager
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
        $faqPage = $this->em
            ->getRepository(CcmFaqPage::class)
            ->findAll();

        if (count($faqPage)) {
            $faqPage = $faqPage[0];

            $rubriquesCollection = $this
                ->em
                ->getRepository(CcmRubriquesCollection::class)
                ->getWidgetsDependingOnPostion(
                    $faqPage->getId()
                );

            if ($rubriquesCollection) {
                $rubriques = [];
                $rubriqueRepository = $this->em->getRepository(CcmRubriqueTranslation::class);

                foreach ($rubriquesCollection as $widget) {
                    $rubrique = $rubriqueRepository
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
            $questionsCollectionRepo = $this->em->getRepository(CcmRubriqueQuestionsCollection::class);
            $questionsRepo = $this->em->getRepository(CcmRubriqueQuestionTranslation::class);

            foreach ($rubriques as $widget) {
                $translatableId = $widget->getTranslatable()->getId();
                $questionsCollection = $questionsCollectionRepo
                    ->getDependingOnPositionAndRubrique($translatableId);

                if ($questionsCollection) {
                    $questionsAnswers[$translatableId] = [];

                    foreach ($questionsCollection as $item) {
                        $questionAnswer = $questionsRepo
                            ->getQuestionAnswerByLocaleAndTranslatableId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $item->getRubriqueQuestion()
                            );

                        if ($questionAnswer) {
                            $questionsAnswers[$translatableId][] = $questionAnswer;
                        }
                    }
                }
            }

            return $questionsAnswers;
        }

        return [];
    }
}

<?php

namespace Base\AdminBundle\Admin\CCM;


use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use Sonata\AdminBundle\Form\FormMapper;

class CcmShortFilmCompetitionTabPalmaresAdmin extends CcmShortFilmCompetitionTabAdmin
{
    protected $baseRoutePattern = 'ccmcompetitionpalmares';
    protected $baseRouteName = 'ccm_competition_palmares';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCompetitionTab::TYPE_PALMARES);

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper
            ->add('selectionSection', 'sonata_type_model_list', array(
                    'label'    => 'form.ccm.label.film_selection',
                    'required' => true,
                    'btn_add' => false,
                )
            )
        ;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCompetitionTab::TYPE_PALMARES);
    }
}

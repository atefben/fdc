<?php

namespace Base\AdminBundle\Admin\CCM;


use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CcmShortFilmCompetitionTabJuryAdmin
 *
 * @package Base\AdminBundle\Admin\CCM
 */
class CcmShortFilmCompetitionTabJuryAdmin extends CcmShortFilmCompetitionTabAdmin
{
    protected $baseRoutePattern = 'ccmcompetitionjury';
    protected $baseRouteName = 'ccm_competition_jury';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCompetitionTab::TYPE_JURY);

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper
            ->add('juryType', 'sonata_type_model_list', array(
                    'label'    => 'form.ccm.label.film_jury',
                    'required' => true,
                    'btn_add' => false,
                )
            )
            ->add('dateJury', 'choice', array(
                    'label'    => 'form.ccm.label.film_jury_date',
                    'required' => true,
                    'choices' => $this->buildYearChoices()
                )
            );
        ;
    }

    protected function buildYearChoices() {
        $distance = 5;
        $yearsBefore = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $distance));
        $yearsAfter = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") + $distance));
        return array_combine(range($yearsBefore, $yearsAfter), range($yearsBefore, $yearsAfter));
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCompetitionTab::TYPE_JURY);
    }
}

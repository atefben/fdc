<?php

namespace Base\AdminBundle\Admin\CCM;


use Doctrine\ORM\QueryBuilder;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class CcmShortFilmCornerWhoAreWeAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class CcmShortFilmCornerWhoAreWeAdmin extends CcmShortFilmCornerAdmin
{
    protected $baseRoutePattern = 'ccmsfcwhoarewe';
    protected $baseRouteName = 'ccm_sfc_who_are_we';

    /**
     * @param string $context
     * 
     * @return QueryBuilder
     */
    public function createQuery($context = 'list')
    {
        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCorner::TYPE_WHO_ARE_WE);

        return $query;
    }

    /**
     * @param mixed $page
     * 
     * @return mixed|void
     */
    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCorner::TYPE_WHO_ARE_WE);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        //$this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager')
        // todo: get choices and handle position change
        parent::configureFormFields($formMapper);
        $formMapper
            ->add('position', 'choice',[
                'choices' => [1,2,3]
            ])
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list', 'create', 'delete']);
    }
}

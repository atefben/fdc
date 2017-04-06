<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class GraphicalCharterSectionPositionDummyAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('graphicalCharterSection', 'sonata_type_model_list', array(
                     'required' => true,
                 )
            )
        ;
    }
}

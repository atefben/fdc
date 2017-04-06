<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class GraphicalCharterSectionThreeColumnsThreeDummyAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('graphicalCharterButtonGroup3', 'sonata_type_model_list', [
                    'required' => true,
                ]
            );
    }
}

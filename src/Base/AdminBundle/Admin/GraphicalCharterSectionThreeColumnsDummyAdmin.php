<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class GraphicalCharterSectionThreeColumnsDummyAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('graphicalCharterButtonGroup', 'sonata_type_model_list', [
                    'required' => true,
                ]
            );
    }
}

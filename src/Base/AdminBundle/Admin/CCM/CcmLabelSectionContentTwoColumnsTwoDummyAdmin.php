<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class CcmLabelSectionContentTwoColumnsTwoDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('labelContentFiles2', 'sonata_type_model_list', array(
                     'required' => true,
                 )
            )
        ;
    }
}

<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class ImageDummyThreeAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image3', 'sonata_type_model_list', array(
                      'required' => true,
                  )
            )
        ;
    }
}

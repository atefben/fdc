<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class MdfThemeDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('theme', 'sonata_type_model_list', array(
                'label' => 'form.mdf.content_template.theme',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false
            ))
        ;
    }
}

<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class FDCPageParticipateSectionWidgetTypeoneMediaImageDummyAdmin
 * @package Base\AdminBundle\Admin
 */
class FDCPageParticipateSectionWidgetTypeoneMediaImageDummyAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list');
    }
}

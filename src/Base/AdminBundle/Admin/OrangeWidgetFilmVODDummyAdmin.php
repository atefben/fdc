<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class OrangeWidgetFilmVODDummyAdmin extends Admin
{

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list', array(
              'help' => 'form.helper_orange_widget_film_vod_image',
            ))
        ;
    }
}

<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Base\AdminBundle\Admin\ServiceWidgetAdmin;
use Base\AdminBundle\Admin\ServiceWidgetProductAdmin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ServiceWidgetType
 * @package Base\AdminBundle\Form\Type
 */
class ServiceWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\ServiceWidget';

    /**
     * @var ServiceWidgetAdmin
     */
    private $serviceWidgetAdmin;

    /**
     * @var ServiceWidgetProductAdmin
     */
    private $serviceWidgetProductAdmin;

    public function setServiceWidgetAdmin($serviceWidgetAdmin)
    {
        $this->serviceWidgetAdmin = $serviceWidgetAdmin;
    }

    public function setServiceWidgetProductAdmin($serviceWidgetProductAdmin)
    {
        $this->serviceWidgetProductAdmin = $serviceWidgetProductAdmin;
    }

    /**
     * buildForm function.
     *
     * @access public
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_type', 'hidden', array(
                'data'   => $this->getName(),
                'mapped' => false
            ))
            ->add('position', 'hidden')
            ->add('translations', 'a2lix_translations', array(
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'url'          => array(
                        'label'              => 'form.label.service_widget_tab_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title'        => array(
                        'label'              => 'form.label.service_widget_tab_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subTitle'     => array(
                        'label'              => 'form.label.service_widget_tab_sub_title',
                        'translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('products', 'sonata_type_collection', array(
                'label' => 'form.label_product',
                'by_reference' => false,
                'sonata_field_description' =>  $this->serviceWidgetAdmin->getFormFieldDescriptions()['products'],
//                'model_manager' => $this->serviceWidgetProductAdmin->getModelManagr(),
//                'class' => $this->serviceWidgetProductAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
            ));
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'  => $this->dataClass,
            'model_class' => $this->dataClass,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'service_widget_type';
    }
}
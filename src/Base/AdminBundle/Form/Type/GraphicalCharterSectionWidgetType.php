<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Entity\GraphicalCharterSectionWidget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GraphicalCharterSectionWidgetType extends AbstractType
{
    protected $dataClass = GraphicalCharterSectionWidget::class;

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
            ->add('_type', 'hidden', [
                'data'   => $this->getName(),
                'mapped' => false
            ])
            ->add('position', 'hidden')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'  => $this->dataClass,
                'model_class' => $this->dataClass,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphical_charter_section_widget_type';
    }
}

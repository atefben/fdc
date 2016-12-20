<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.12.2016
 * Time: 12:00
 */

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentTemplateWidgetType extends AbstractType
{
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidget';

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
        return 'content_template_widget_type';
    }
}

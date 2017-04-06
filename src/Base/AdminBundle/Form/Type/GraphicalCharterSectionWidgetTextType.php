<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetText;
use Symfony\Component\Form\FormBuilderInterface;

class GraphicalCharterSectionWidgetTextType extends GraphicalCharterSectionWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = GraphicalCharterSectionWidgetText::class;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
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
                    'text' => array(
                        'label' => 'form.ccm.graphical_charter.widget_text.text',
                        'translation_domain' => 'BaseAdminBundle',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'required' => true,
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget'
                    )
                )
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphical_charter_section_widget_text_type';
    }
}

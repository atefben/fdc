<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class ContentTemplateWidgetTextType extends ContentTemplateWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetText';

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
                    'title' => array(
                        'label' => 'form.mdf.content_template.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'contentText' => array(
                        'label' => 'form.mdf.content_template.label.text',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'required' => true,
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget'
                    )
                ),
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'content_template_widget_text_type';
    }
}

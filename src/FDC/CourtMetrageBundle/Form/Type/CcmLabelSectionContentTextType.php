<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class CcmLabelSectionContentTextType extends CcmLabelSectionContentType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmLabelSectionContentText';

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
                'locales' => ['fr','en'],
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
        return 'ccm_label_section_content_text_type';
    }
}

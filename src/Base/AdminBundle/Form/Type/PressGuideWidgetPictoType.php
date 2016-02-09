<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Util\WidgetIcon;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Base\CoreBundle\Entity\PressGuideWidget;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressGuideWidgetPictoType class.
 *
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressGuideWidgetPictoType extends PressGuideWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\CoreBundle\Entity\PressGuideWidgetPicto')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\PressGuideWidgetPicto';

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
        parent::buildForm($builder, $options);
        $builder->add('translations', 'a2lix_translations', array(
            'translation_domain' => 'BaseAdminBundle',
            'required_locales' => array('fr'),
            'fields' => array(
                'title' => array(
                    'label' => 'form.label_title',
                    'translation_domain' => 'BaseAdminBundle',
                    'locale_options' => array(
                        'fr' => array(
                            'required' => true
                        )
                    )
                ),
                'content' => array(
                    'field_type' => 'ckeditor',
                    'label' => 'form.label_content',
                    'sonata_help' => 'form.press_homepage.helper_desc',
                    'translation_domain' => 'BaseAdminBundle'
                )
            )
        ))
        ->add('picto', new ChoiceType() , array(
            'choices' => array(
                'icon_a-votre-service' => 'A votre arrivée',
                'icon_informations' => 'Information',
                'icon_rendez-vous-des-medias' => 'Rendez-vous',
                'icon_service' => 'Services',
            ),
            'choice_translation_domain' => 'BaseAdminBundle'
        ))
        ;
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'press_guide_widget_picto_type';
    }
}
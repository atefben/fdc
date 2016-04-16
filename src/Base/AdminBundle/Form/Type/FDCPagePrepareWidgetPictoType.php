<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Util\WidgetIcon;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Base\CoreBundle\Entity\FDCPagePrepareWidget;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPagePrepareWidgetPictoType class.
 *
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPagePrepareWidgetPictoType extends FDCPagePrepareWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\CoreBundle\Entity\FDCPagePrepareWidgetPicto')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\FDCPagePrepareWidgetPicto';

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
                'createdAt' => array(
                    'display' => false
                ),
                'updatedAt' => array(
                    'display' => false
                ),
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
                    'translation_domain' => 'BaseAdminBundle',
                    'config_name' => 'press'
                ),
                'btnLabel' => array(
                    'label' => 'form.url_btn',
                    'translation_domain' => 'BaseAdminBundle',
                    'locale_options' => array(
                        'fr' => array(
                            'required' => false
                        )
                    )
                ),
            )
        ))
            ->add('picto', new ChoiceType(), array(
                'choices' => array(
                    'icon_train' => 'Train',
                    'icon_voiture' => 'Voiture',
                    'icon_avion' => 'Avion',
                    'icon_bus' => 'Bus',
                    'icon_taxi' => 'Taxi',

                    'icon_wifi' => 'Icone Wifi',
                    'icon_enregistreur' => 'Icone appareil photo',
                    'icon_salle-presse' => 'Icone salle presse',
                    'icon_casier' => 'Icone casier',
                    'icon_plateau-tv' => 'Icone plateau TV',
                    'icon_zone-media' => 'Icone zone media',
                    'icon_transport' => 'Icone transport',
                    'icon_divers' => 'Icone divers',
                ),
                'label' => 'form.label_service_icon',
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle',
                'required' => false,
                'empty_data' => null
            ));
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'fdc_page_prepare_widget_picto_type';
    }
}
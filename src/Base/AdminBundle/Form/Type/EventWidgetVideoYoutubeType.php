<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * NewsWidgetVideoYoutubeType class.
 *
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class EventWidgetVideoYoutubeType extends EventWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\EventWidgetVideoYoutubeType')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\EventWidgetVideoYoutube';

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
            'label' => false,
            'translation_domain' => 'BaseAdminBundle',
            'required_locales' => array(),
            'fields' => array(
                'youtubeId' => array(
                    'constraints' => array(
                        new NotBlank()
                    )
                ),
                'title' => array(
                    'constraints' => array(
                        new NotBlank()
                    )
                ),
                'createdAt' => array(
                    'display' => false
                ),
                'updatedAt' => array(
                    'display' => false
                ),
            )
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
        return 'event_widget_video_youtube_type';
    }
}
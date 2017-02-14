<?php

namespace FDC\CourtMetrageBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

/**
 * CcmNewsWidgetVideoYoutubeType class.
 *
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetVideoYoutubeType extends CcmNewsWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetVideoYoutubeType')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetVideoYoutube';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * mediaImageSimpleAdmin
     *
     * @var mixed
     * @access private
     */
    private $mediaImageSimpleAdmin;

    /**
     * setSonataAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setMediaImageSimpleAdmin($mediaImageSimpleAdmin)
    {
        $this->mediaImageSimpleAdmin = $mediaImageSimpleAdmin;
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
        parent::buildForm($builder, $options);
        $builder
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                 'applyChanges' => array(
                     'field_type' => 'hidden',
                     'attr' => array (
                         'class' => 'hidden'
                     )
                 ),
                    'url' => array(
                        'constraints' => array(
                            new NotBlank(),
                            new Url()
                        ),
                        'required' => true,
                        'label' => 'form.label_news_widget_video_youtube_url',
                        'sonata_help' => 'form.news_widget_video_youtube.helper_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title' => array(
                        'constraints' => array(
                            new NotBlank()
                        ),
                        'required' => true,
                        'label' => 'form.label_news_widget_video_youtube_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                )
            ))
            ->add('image', 'sonata_type_model_list', array(
                'required' => false,
                'label' => 'Image cover',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageSimpleAdmin->getModelManager(),
                'class' => $this->mediaImageSimpleAdmin->getClass()
            ))
        ;
    }

    /**
     * getName function.
     *
     * @access public
     */
    public function getName()
    {
        return 'ccm_news_widget_video_youtube_type';
    }
}
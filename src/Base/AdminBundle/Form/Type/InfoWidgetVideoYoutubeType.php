<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

/**
 * InfoWidgetVideoYoutubeType class.
 *
 * \@extends InfoWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoWidgetVideoYoutubeType extends InfoWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\InfoWidgetVideoYoutubeType')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\InfoWidgetVideoYoutube';

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
     * @return void
     */
    public function getName()
    {
        return 'info_widget_video_youtube_type';
    }
}
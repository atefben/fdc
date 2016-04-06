<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Form\AbstractType as BaseType;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * EventWidgetTextType class.
 * 
 * \@extends EventWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class OrangeWidgetMovieYoutubeType extends BaseType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\CoreBundle\Entity\EventWidgetText')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\OrangeWidgetMovieYoutube';
    
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
        $builder->add('translations', 'a2lix_translations', array(
                    'locales' => array('fr', 'en'),
                    'label' => false,
                    'translation_domain' => 'BaseAdminBundle',
                    'required_locales' => array('fr'),
                    'fields' => array(
                        'title' => array(
                            'constraints' => array(
                            ),
                            'required' => true,
                            'label' => 'form.label_orange_series_widget_video_youtube_title',
                            'translation_domain' => 'BaseAdminBundle',
                        ),
                        'subtitle' => array(
                            'constraints' => array(
                            ),
                            'required' => true,
                            'label' => 'form.label_orange_series_widget_video_youtube_subtitle',
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
                ->add('url', null,  array(
                      'constraints' => array(
                          new Url()
                      ),
                      'required' => true,
                      'label' => 'form.label_orange_series_widget_video_youtube_url',
                      'translation_domain' => 'BaseAdminBundle',
                ))
                ->add('_type', 'hidden', array(
                        'data'   => $this->getName(),
                        'mapped' => false
                ))
                ->add('position', 'hidden')
        ;
    }
    
    /**
     * setDefaultOptions function.
     * 
     * @access public
     * @param OptionsResolverInterface $resolver
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'  => $this->dataClass,
            'model_class' => $this->dataClass,
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
        return 'orange_widget_movie_youtube_type';
    }
}
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
class OrangeWidgetFilmOCSType extends BaseType
{
    /**
     * dataClass
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\OrangeWidgetFilmOCS';
    
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
        $builder->add('translations', 'a2lix_translations', array(
                    'locales' => array('fr', 'en'),
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
                        'legend' => array(
                            'constraints' => array(
                            ),
                            'required' => false,
                            'label' => 'form.label_orange_widget_film_ocs_legend',
                            'translation_domain' => 'BaseAdminBundle',
                        ),
                        'title' => array(
                            'constraints' => array(
                            ),
                            'required' => false,
                            'label' => 'form.label_orange_widget_film_ocs_title',
                            'translation_domain' => 'BaseAdminBundle',
                        ),
                        'description' => array(
                            'constraints' => array(
                            ),
                            'required' => false,
                            'label' => 'form.label_orange_widget_film_ocs_description',
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
                    'required' => true,
                    'label' => 'Image cover',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                    'model_manager' => $this->mediaImageSimpleAdmin->getModelManager(),
                    'class' => $this->mediaImageSimpleAdmin->getClass()
                ))
                ->add('name', 'choice',  array(
                    'required' => true,
                    'choices' => \Base\CoreBundle\Entity\OrangeWidgetFilmOCS::getNames(),
                    'label' => 'form.label_orange_widget_film_ocs_name',
                    'translation_domain' => 'BaseAdminBundle',
                ))
                ->add('producer', null,  array(
                    'required' => false,
                    'label' => 'form.label_orange_widget_film_ocs_producer',
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
        return 'orange_widget_film_ocs_type';
    }
}
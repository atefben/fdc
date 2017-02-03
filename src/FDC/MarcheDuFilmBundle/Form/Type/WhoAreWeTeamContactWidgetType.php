<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Base\AdminBundle\Admin\MediaMdfImageAdmin;
use Symfony\Component\Validator\Constraints\NotBlank;

class WhoAreWeTeamContactWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamContactWidget';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_type', 'hidden', array(
                'data'   => $this->getName(),
                'mapped' => false
            ))
            ->add('position', 'hidden')
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
                    'date'          => array(
                        'label'              => 'form.mdf.label.who_are_we_team.contact_widget_date',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => true
                    ),
                    'address'          => array(
                        'label'              => 'form.mdf.label.who_are_we_team.contact_widget_address',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => true
                    ),
                    'phone'          => array(
                        'label'              => 'form.mdf.label.who_are_we_team.contact_widget_phone',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => true
                    )
                ),
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'  => $this->dataClass,
                'model_class' => $this->dataClass,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'who_are_we_team_contact_widget_type';
    }
}

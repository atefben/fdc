<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Base\AdminBundle\Admin\CCM\CcmRegisterProcedureAdmin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmFilmRegisterProcedureType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmFilmRegisterProcedure';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var CcmRegisterProcedureAdmin
     */
    private $registerProcedureAdmin;

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

    public function setRegisterProcedureAdmin($registerProcedureAdmin)
    {
        $this->registerProcedureAdmin = $registerProcedureAdmin;
    }

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
            ->add('procedure', 'sonata_type_model_list', array(
                'constraints'        => array(
                    new NotBlank(),
                ),
                'label' => 'form.ccm.film_register.label_procedure',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['procedure'],
                'model_manager' => $this->registerProcedureAdmin->getModelManager(),
                'class' => $this->registerProcedureAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('position', 'hidden')
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
        return 'film_register_procedure';
    }
}

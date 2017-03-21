<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Base\AdminBundle\Admin\CCM\CcmRegisterProcedureAdmin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmLabelSectionPositionType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmLabelSectionPosition';

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
    private $labelSection;

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

    public function setLabelSectionAdmin($labelSectionAdmin)
    {
        $this->labelSection = $labelSectionAdmin;
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
            ->add('labelSection', 'sonata_type_model_list', array(
                'constraints'        => array(
                    new NotBlank(),
                ),
                'label' => 'form.ccm.graphical_charter.section',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['labelSection'],
                'model_manager' => $this->labelSection->getModelManager(),
                'class' => $this->labelSection->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'btn_add' => false,
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
        return 'ccm_label_section_position_type';
    }
}

<?php

namespace Base\AdminBundle\Form\Type;

use Base\AdminBundle\Admin\CCM\CcmRegisterProcedureAdmin;
use Base\CoreBundle\Entity\GraphicalCharterSectionPosition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GraphicalCharterSectionPositionType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = GraphicalCharterSectionPosition::class;

    /**
     * @var
     */
    private $admin;

    /**
     * @var CcmRegisterProcedureAdmin
     */
    private $graphicalCharterSectionAdmin;

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

    public function setGraphicalCharterSectionAdmin($graphicalCharterSectionAdmin)
    {
        $this->graphicalCharterSectionAdmin = $graphicalCharterSectionAdmin;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_type', 'hidden', [
                'data'   => $this->getName(),
                'mapped' => false
            ])
            ->add('graphicalCharterSection', 'sonata_type_model_list', [
                'constraints'              => [
                    new NotBlank(),
                ],
                'label'                    => 'form.ccm.graphical_charter.section',
                'sonata_field_description' => $this->admin->getFormFieldDescriptions()['graphicalCharterSection'],
                'model_manager'            => $this->graphicalCharterSectionAdmin->getModelManager(),
                'class'                    => $this->graphicalCharterSectionAdmin->getClass(),
                'translation_domain'       => 'BaseAdminBundle',
                'btn_delete'               => false,
                'btn_add'                  => false,
                'required'                 => true
            ])
            ->add('position', 'hidden')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'  => $this->dataClass,
                'model_class' => $this->dataClass,
            ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphical_charter_section_position_type';
    }
}

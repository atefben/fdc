<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Base\AdminBundle\Admin\MediaMdfPdfAdmin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramFileType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfProgramFile';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var MediaMdfPdfAdmin
     */
    private $mediaFileAdmin;

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

    public function setMediaFileAdmin($mediaFileAdmin)
    {
        $this->mediaFileAdmin = $mediaFileAdmin;
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
            ->add('file', 'sonata_type_model_list', array(
                'label' => 'form.label_file',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['file'],
                'model_manager' => $this->mediaFileAdmin->getModelManager(),
                'class' => $this->mediaFileAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ));
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
        return 'program_file_type';
    }
}
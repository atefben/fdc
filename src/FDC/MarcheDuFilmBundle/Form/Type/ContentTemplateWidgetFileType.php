<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Base\AdminBundle\Admin\MediaMdfPdfAdmin;

class ContentTemplateWidgetFileType extends ContentTemplateWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetFile';

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
        parent::buildForm($builder, $options);
        $builder
            ->add('file', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['file'],
                'model_manager' => $this->mediaFileAdmin->getModelManager(),
                'class' => $this->mediaFileAdmin->getClass(),
                'btn_delete' => false,
                'label' => 'form.label_file'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'content_template_widget_file_type';
    }
}

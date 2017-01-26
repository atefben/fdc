<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Base\AdminBundle\Admin\MediaMdfVideoAdmin;

class ContentTemplateWidgetVideoType extends ContentTemplateWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideo';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var MediaMdfVideoAdmin
     */
    private $mediaVideoAdmin;

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

    public function setMediaVideoAdmin($mediaVideoAdmin)
    {
        $this->mediaVideoAdmin = $mediaVideoAdmin;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('video', 'sonata_type_model_list', array(
                'label' => 'form.label_video',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['video'],
                'model_manager' => $this->mediaVideoAdmin->getModelManager(),
                'class' => $this->mediaVideoAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => false
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'content_template_widget_video_type';
    }
}

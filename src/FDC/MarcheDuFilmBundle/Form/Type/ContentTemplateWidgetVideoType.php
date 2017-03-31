<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Base\AdminBundle\Admin\MediaMdfImageAdmin;
use Base\AdminBundle\Admin\MdfThemeAdmin;

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
     * admin
     *
     * @var mixed
     * @access private
     */
    private $sonataThemeAdmin;

    /**
     * @var MediaMdfImageAdmin
     */
    private $mediaImageAdmin;

    /**
     * @var MdfThemeAdmin
     */
    private $themeAdmin;

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

    /**
     * setSonataAdmin function.
     *
     * @access public
     * @param mixed $sonataThemeAdmin
     * @return void
     */
    public function setSonataThemeAdmin($sonataThemeAdmin)
    {
        $this->sonataThemeAdmin = $sonataThemeAdmin;
    }

    public function setMediaImageAdmin($mediaImageAdmin)
    {
        $this->mediaImageAdmin = $mediaImageAdmin;
    }

    public function setThemeAdmin($themeAdmin)
    {
        $this->themeAdmin = $themeAdmin;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
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
                    'title'          => array(
                        'label'              => 'form.mdf.label.title',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'url'          => array(
                        'label'              => 'form.mdf.label.youtube_url',
                        'translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.label_image',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageAdmin->getModelManager(),
                'class' => $this->mediaImageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => false
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'label' => 'form.mdf.content_template.theme',
                'sonata_field_description' =>  $this->sonataThemeAdmin->getFormFieldDescriptions()['theme'],
                'model_manager' => $this->themeAdmin->getModelManager(),
                'class' => $this->themeAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'content_template_widget_video_type';
    }
}

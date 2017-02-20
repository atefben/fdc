<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\Statement;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class HomepageCorporateSlideAdmin extends Admin
{

    public function toString($object)
    {
        if ($object instanceof Statement || $object instanceof Info) {
            $fr = $object->findTranslationByLocale('fr');
            if ($fr && method_exists($fr, 'getTitle') && $fr->getTitle()) {
                return $fr->getTitle();
            }
        }
        return parent::toString($object);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('infos')
            ->add('statement')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('info', 'sonata_type_model_list', array('btn_add' => false,'btn_delete' => false), ['eee'=> "ee"])
            ->add('statement', 'sonata_type_model_list', array('btn_add' => false,'btn_delete' => false))
            ->add('position','hidden',array('attr'=>array("hidden" => true)))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
        ;
    }
}

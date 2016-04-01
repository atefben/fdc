<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Admin\Entity;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\UserBundle\Admin\Entity\UserAdmin as SonataUserAdmin;

class UserAdmin extends SonataUserAdmin
{

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('groups')
            ->add('email')
            ->add('firstname')
            ->add('lastname')
            ->add('enabled', null, array('editable' => true))
            ->add('createdAt', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }

                    $dateTime1 = $value['value']->format('Y-m-d') . ' 00:00:00';
                    $dateTime2 = $value['value']->format('Y-m-d') . ' 23:59:59';
                    $queryBuilder->andWhere("{$alias}.createdAt BETWEEN :datetime1 AND :datetime2");
                    $queryBuilder->setParameter('datetime1', $dateTime1);
                    $queryBuilder->setParameter('datetime2', $dateTime2);

                    return true;
                },
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                )
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username')
            ->add('groups')
            ->add('email')
            ->add('firstname')
            ->add('lastname')
            ->add('enabled', null, array('editable' => true))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array(
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
            ))
            ->end()
            ->with('Groups')
            ->add('groups')
            ->end()
            ->with('Profile')
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->end()
        ;

        if ($this->getSubject() && $this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                ->add('realRoles', 'sonata_security_roles', array(
                    'label'    => 'form.label_roles',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false
                ))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end()
            ;
        }
    }

    public function getExportFields()
    {
        return array(
            'Id'                      => 'id',
            'Login'                   => 'username',
            'Activé'                  => 'exportEnabled',
            'Nom'                     => 'lastname',
            'Prénom'                  => 'firstname',
            'Email'                   => 'email',
            'Téléphone'               => 'phone',
            'Groupe(s)'               => 'exportGroup',
            'Date de création'        => 'exportCreatedAt',
            'Date de modification'    => 'exportUpdatedAt',
            'Date dernière connexion' => 'exportLastLogin',
        );
    }

    public function getExportFormats()
    {
        return array('xls');
    }

}

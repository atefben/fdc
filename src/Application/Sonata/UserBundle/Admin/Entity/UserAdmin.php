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
            ->add('dateOfBirth', 'birthday', array('required' => false))
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('website', 'url', array('required' => false))
            ->add('biography', 'text', array('required' => false))
            ->add('gender', 'sonata_user_gender', array(
                'required'           => true,
                'translation_domain' => $this->getTranslationDomain()
            ))
            ->add('locale', 'locale', array('required' => false))
            ->add('timezone', 'timezone', array('required' => false))
            ->add('phone', null, array('required' => false))
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

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
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;

use Sonata\UserBundle\Admin\Entity\UserAdmin as SonataUserAdmin;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserAdmin extends SonataUserAdmin
{
    const ROLE_CCM = 'ROLE_ADMIN_CCM';

    protected $ccmUserTypes = [
        self::ROLE_CCM => [
            self::ROLE_CCM,
        ],
    ];

    /**
     * @param string $context
     * @return QueryBuilder
     */
    public function createQuery($context = 'list')
    {
        $currentUser = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        if ($currentUser) {
            if ($roles = $currentUser->getRoles()) {
                foreach ($roles as $role) {
                    if (isset($this->ccmUserTypes[$role])) {
                        $userRoles = $this->ccmUserTypes[$role];
                        break;
                    }
                }

                if (isset($userRoles) && $userRoles) {
                    /** @var QueryBuilder $query */
                    $query = parent::createQuery($context);
                    $query
                        ->andWhere($query->expr()->like('s_groups.roles', $query->expr()->literal('%'.$userRoles[0].'%')));

                    if (count($userRoles) > 1) {
                        foreach (array_slice($userRoles, 1) as $role) {
                            $query
                                ->orWhere($query->expr()->like('s_groups.roles', $query->expr()->literal('%'.$role.'%')));
                        }
                    }

                } else {
                    $query = parent::createQuery($context);
                }
            } else {
                $query = parent::createQuery($context);
            }
        } else {
            $query = parent::createQuery($context);
        }

        return $query;
    }
    
    public function prePersist($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $templating = $container->get('templating');

        $message = \Swift_Message::newInstance()->setSubject('Activation de votre compte à l\'interface d\'administration du Festival de Cannes')->setFrom($object->getEmail())->setTo($object->getEmail())->setBody($templating->render('ApplicationSonataAdminBundle::user_email.html.twig', array(
            'username' => $object->getUsername(),
            'password' => $object->getPlainPassword(),
            'role'     => $object->getGroups()
        )), 'text/html');
        $mailer  = $container->get('mailer');
        $mailer->send($message);

    }

    public function preUpdate($object)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $templating = $container->get('templating');

        $message = \Swift_Message::newInstance()->setSubject('Activation de votre compte à l\'interface d\'administration du Festival de Cannes')->setFrom($object->getEmail())->setTo($object->getEmail())->setBody($templating->render('ApplicationSonataAdminBundle::user_email.html.twig', array(
            'username' => $object->getUsername(),
            'password' => $object->getPlainPassword(),
            'role'     => $object->getGroups()
        )), 'text/html');
       $mailer  = $container->get('mailer');
       $mailer->send($message);

    }

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
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                ),
                'translation_domain' => 'BaseAdminBundle',
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->end();
        $currentUser = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        if ($currentUser) {
            if ($roles = $currentUser->getRoles()) {
                foreach ($roles as $role) {
                    if (isset($this->ccmUserTypes[$role])) {
                        $userRoles = $this->ccmUserTypes[$role];
                        break;
                    }
                }

                if (isset($userRoles) && $userRoles) {
                    /** @var QueryBuilder $query */

                    $formMapper
                        ->with('Groups')
                        ->add('groups', null, array('required' => true,
                                'query_builder' => function (EntityRepository $er) use ($userRoles) {
                                    $qd = $er->createQueryBuilder('u');
                                    $qd->andWhere($qd->expr()->like('u.roles', $qd->expr()->literal('%'.$userRoles[0].'%')));

                                    if (count($userRoles) > 1) {
                                        foreach (array_slice($userRoles, 1) as $role) {
                                            $qd->orWhere($qd->expr()->like('u.roles', $qd->expr()->literal('%'.$role.'%')));
                                        }
                                    }

                                    return $qd;
                                },
                            )
                        )
                        ->end();
                } else {
                    $formMapper
                        ->with('Groups')
                        ->add('groups', null, array(
                                'required' => true
                            )
                        )
                        ->end();
                }
            }
        }

        $formMapper
            ->with('Profile')
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('enabled')
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

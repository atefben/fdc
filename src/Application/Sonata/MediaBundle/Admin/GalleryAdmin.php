<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\MediaBundle\Admin\GalleryAdmin as SonataGalleryAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\MediaBundle\Provider\Pool;
use Sonata\MediaBundle\Form\DataTransformer\ProviderDataTransformer;

use Knp\Menu\ItemInterface as MenuItemInterface;


class GalleryAdmin extends SonataGalleryAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        // define group zoning
        $formMapper
            ->with($this->trans('Gallery'))->end()
        ;

        $context = $this->getPersistentParameter('context');

        if (!$context) {
            $context = $this->pool->getDefaultContext();
        }

        $formats = array();
        foreach ((array) $this->pool->getFormatNamesByContext($context) as $name => $options) {
            $formats[$name] = $name;
        }

        $contexts = array();
        foreach ((array) $this->pool->getContexts() as $contextItem => $format) {
            $contexts[$contextItem] = $contextItem;
        }

        $formMapper
            ->with('Options')
                ->add('context', 'sonata_type_translatable_choice', array(
                    'choices'   => $contexts,
                    'catalogue' => 'SonataMediaBundle',
                ))
                ->add('enabled', null, array('required' => false))
                ->add('name')
                ->add('defaultFormat', 'choice', array('choices' => $formats))
            ->end()
            ->with('Gallery')
                ->add('galleryHasMedias', 'sonata_type_collection', array(
                        'cascade_validation' => true,
                    ), array(
                        'edit'              => 'inline',
                        'inline'            => 'table',
                        'sortable'          => 'position',
                        'link_parameters'   => array('context' => $context),
                        'admin_code'        => 'sonata.media.admin.gallery_has_media',
                    )
                )
            ->end()
        ;
    }
}

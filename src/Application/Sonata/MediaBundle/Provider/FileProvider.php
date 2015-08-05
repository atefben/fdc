<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Appplication\Sonata\MediaBundle\Provider;

use Sonata\AdminBundle\Form\FormMapper;

use Sonata\MediaBundle\Provider\FileProvider as SonataFileProvider;

class FileProvider extends SonataFileProvider
{
    public function buildEditForm(FormMapper $formMapper)
    {
        $formMapper->add('name');
        $formMapper->add('enabled', null, array('required' => false));
        $formMapper->add('authorName');
        $formMapper->add('cdnIsFlushable');
        $formMapper->add('description');
        $formMapper->add('translations', 'a2lix_translations', array(
            'fields' => array(
                // hide fields
                'createdAt' => array(
                    'display' => false
                ),
                'updatedAt' => array(
                    'display' => false
                )
            )
        ));
        $formMapper->add('binaryContent', 'file', array('required' => false));
    }
}

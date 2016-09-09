<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\CoreBundle\Transformer;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class QuietPropertyAccessor
 * @package Base\CoreBundle\Transformer
 */
class QuietPropertyAccessor extends PropertyAccessor
{
    public function getValue($object, $propertyPath)
    {
        try {
            return parent::getValue($object, $propertyPath);
        } catch (\Exception $e) {
            return new ArrayCollection();
        }
    }
}

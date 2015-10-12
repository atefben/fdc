<?php

namespace Base\ApiBundle\Exclusion;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\Serializer\Exclusion\ExclusionStrategyInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;
use JMS\Serializer\Context;

use Base\CoreBundle\Entity\MediaTranslationInterface;
/**
 * StatusExclusionStrategy
 *
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 * \@description Custom Exclusion Strategy based on the status, if not published return null instead of object
 *
 * @Service("base.api.status_exclusion_strategy")
 */
class StatusExclusionStrategy implements ExclusionStrategyInterface
{
    public function shouldSkipClass(ClassMetadata $metadata, Context $navigatorContext)
    {
        if (method_exists($navigatorContext->getObject(), 'getStatus') &&
            $navigatorContext->getObject()->getStatus() != MediaTranslationInterface::STATUS_PUBLISHED) {
            return true;
        }

        return false;
    }

    public function shouldSkipProperty(PropertyMetadata $property, Context $navigatorContext)
    {
        return false;
    }
}
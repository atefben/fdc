<?php

namespace Base\ApiBundle\Exclusion;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\Serializer\Exclusion\ExclusionStrategyInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;
use JMS\Serializer\Context;

use Base\CoreBundle\Entity\MediaTranslationInterface;
/**
 * TranslationExclusionStrategy
 *
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 * \@description Custom Exclusion Strategy based on the status, if not published return null instead of object
 *
 * @Service("base.api.translation_exclusion_strategy")
 */
class TranslationExclusionStrategy implements ExclusionStrategyInterface
{
    private $locale;

    public function __construct($locale)
    {
        $this->locale = $locale;
    }
    public function shouldSkipClass(ClassMetadata $metadata, Context $navigatorContext)
    {
        if (method_exists($navigatorContext->getObject(), 'getLocale') &&
            $navigatorContext->getObject()->getLocale() != $this->locale) {
            return true;
        }

        return false;
    }

    public function shouldSkipProperty(PropertyMetadata $property, Context $navigatorContext)
    {
        return false;
    }
}
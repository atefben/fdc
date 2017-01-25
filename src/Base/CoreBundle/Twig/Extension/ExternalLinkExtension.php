<?php

namespace Base\CoreBundle\Twig\Extension;

use Twig_Extension;

/**
 * Class ExternalLinkExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class ExternalLinkExtension extends Twig_Extension
{
    private $eventDomain;
    private $eventMobileDomain;
    private $pressDomain;
    private $corpoDomain;

    /**
     * @param mixed $eventMobileDomain
     * @return ExternalLinkExtension
     */
    public function setEventMobileDomain($eventMobileDomain)
    {
        $this->eventMobileDomain = $eventMobileDomain;
        return $this;
    }

    /**
     * @param mixed $corpoDomain
     * @return ExternalLinkExtension
     */
    public function setCorpoDomain($corpoDomain)
    {
        $this->corpoDomain = $corpoDomain;
        return $this;
    }

    /**
     * @param mixed $pressDomain
     * @return ExternalLinkExtension
     */
    public function setPressDomain($pressDomain)
    {
        $this->pressDomain = $pressDomain;
        return $this;
    }

    /**
     * @param mixed $eventDomain
     * @return ExternalLinkExtension
     */
    public function setEventDomain($eventDomain)
    {
        $this->eventDomain = $eventDomain;
        return $this;
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('external_link', array($this, 'externalLink')),
        );
    }

    public function externalLink($url)
    {
        if (parse_url($url, PHP_URL_SCHEME)) {
            $hosts = [
                $this->eventDomain,
                $this->eventMobileDomain,
                $this->corpoDomain,
                $this->pressDomain,
            ];
            $currentHost = parse_url($url, PHP_URL_HOST);
            if (!in_array($currentHost, $hosts)) {
                return 'target="_blank"';
            }
        }
        return '';
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'external_link_extension';
    }
}
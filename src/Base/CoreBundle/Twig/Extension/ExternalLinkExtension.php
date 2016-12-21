<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * Class ExternalLinkExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class ExternalLinkExtension extends Twig_Extension
{
    private $em;

    private $eventDomain;
    private $eventMobileDomain;
    private $pressDomain;
    private $corpoDomain;

    /**
     * @return mixed
     */
    public function getEventDomain()
    {
        return $this->eventDomain;
    }

    /**
     * @return mixed
     */
    public function getEventMobileDomain()
    {
        return $this->eventMobileDomain;
    }

    /**
     * @return mixed
     */
    public function getPressDomain()
    {
        return $this->pressDomain;
    }

    /**
     * @return mixed
     */
    public function getCorpoDomain()
    {
        return $this->corpoDomain;
    }

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



    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('external_link', array($this, 'externalLink')),
        );
    }

    public function externalLink($object)
    {
        if(parse_url($object, PHP_URL_SCHEME)) {
            $hosts = [
                $this->getEventDomain(),
                $this->getEventMobileDomain(),
                $this->getCorpoDomain(),
                $this->getPressDomain(),
            ];
            $currentHost = parse_url($object, PHP_URL_HOST);
            if (!in_array($currentHost,$hosts)) {
                return 'target="_blank"';
            }
       }
       return '';
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'external_link_extension';
    }
}
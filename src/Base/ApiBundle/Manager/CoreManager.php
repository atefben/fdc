<?php

namespace Base\ApiBundle\Manager;

use \Exception;

use Doctrine\ORM\NoResultException;

use JMS\Serializer\SerializationContext;

/**
 * CoreManager class.
 *
 * @author Antoine Mineau
 * \@company Ohwee
 */
class CoreManager
{
    /**
     * em
     * 
     * @var mixed
     * @access private
     */
    private $em;
    
    /**
     * apiPageOffset
     * 
     * @var mixed
     * @access private
     */
    private $apiPageOffset;
    
    /**
     * apiVersion
     * 
     * @var mixed
     * @access private
     */
    private $apiVersion;
    
    /**
     * knpPaginator
     * 
     * @var mixed
     * @access private
     */
    private $knpPaginator;

    /**
     * @var
     */
    private $locale;

    /**
     * setEntityManager function.
     * 
     * @access public
     * @param mixed $em
     * @return void
     */
    public function setEntityManager($em)
    {
        $this->em = $em;
    }
    
    /**
     * setApiPageOffset function.
     * 
     * @access public
     * @param mixed $apiPageOffset
     * @return void
     */
    public function setApiPageOffset($apiPageOffset)
    {
        $this->apiPageOffset = $apiPageOffset;
    }
    
    /**
     * setKnpPaginator function.
     * 
     * @access public
     * @param mixed $knpPaginator
     * @return void
     */
    public function setKnpPaginator($knpPaginator)
    {
        $this->knpPaginator = $knpPaginator;
    }
    
    /**
     * setApiVersion function.
     * 
     * @access public
     * @param mixed $apiVersion
     * @return void
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @param $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return mixed
     */
    public function getApiFestivalYear()
    {
        $settings = $this->em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-api-year');
        if ($settings == null) {
            throw new Exception('Settings not found');
        }

        return $settings->getFestival();
    }

    /**
     * @param $query
     * @param $paramFetcher
     * @param array $options
     * @return mixed
     */
    public function getPaginationItems($query, $paramFetcher, $options = array())
    {
        $offset = ($paramFetcher->get('offset') !== null) ? (int)$paramFetcher->get('offset') : $this->apiPageOffset;
        $offset = ($offset <= 10) ? $offset : 10;
        $page = ($paramFetcher->get('page') !== null) ? (int)$paramFetcher->get('page') : 1;

        $pagination = $this->knpPaginator->paginate(
            $query,
            $page,
            $offset,
            $options
        );
        
        return $pagination->getItems();
    }
    
    /**
     * setContext function.
     * 
     * @access public
     * @param mixed $groups
     * @param mixed $paramFetcher
     * @return void
     */
    public function setContext($groups, $paramFetcher)
    {
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->apiVersion;

        $context = SerializationContext::create();
        $context->setGroups($groups);
        $context->setVersion($version);
        
        return $context;
    }

}
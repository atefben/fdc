<?php

namespace FDC\SoifBundle\Manager;

use \SoapClient;
use \SoapFault;

/**
 * Abstract CoreManager class.
 * 
 * @abstract
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
abstract class CoreManager
{
    /**
     * client
     * 
     * @var mixed
     * @access protected
     */
    protected $client;
    
    /**
     * em
     * 
     * @var mixed
     * @access protected
     */
    protected $em;
    
    /**
     * logger
     * 
     * @var mixed
     * @access protected
     */
    protected $logger;
    
    /**
     * uploadDirectoryHD
     * 
     * @var mixed
     * @access protected
     */
    protected $uploadDirectoryHD;
    
    /**
     * uploadDirectorySD
     * 
     * @var mixed
     * @access protected
     */
    protected $uploadDirectorySD;
    
    /**
     * timer
     * 
     * @var mixed
     * @access private
     */
    private $timer;
    
    /**
     * wsUrl
     * 
     * @var mixed
     * @access private
     */
    private $wsUrl;
    
    /**
     * entityIdKey
     * 
     * @var mixed
     * @access protected
     */
    protected $entityIdKey;
    
    /**
     * wsParameterKey
     * 
     * @var mixed
     * @access protected
     */
    protected $wsParameterKey;
    
    /**
     * repository
     * 
     * @var mixed
     * @access protected
     */
    protected $repository;
    
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
     * setLogger function.
     * 
     * @access public
     * @param mixed $logger
     * @return void
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
    
    /**
     * setUploadDirectoryHD function.
     * 
     * @access public
     * @param mixed $uploadDirectoryHD
     * @return void
     */
    public function setUploadDirectoryHD($uploadDirectoryHD)
    {
        $this->uploadDirectoryHD = $uploadDirectoryHD;
    }
    
    /**
     * setUploadDirectorySD function.
     * 
     * @access public
     * @param mixed $uploadDirectorySD
     * @return void
     */
    public function setUploadDirectorySD($uploadDirectorySD)
    {
        $this->uploadDirectorySD = $uploadDirectorySD;
    }
    
    /**
     * setWebserviceUrl function.
     * 
     * @access public
     * @param mixed $wsUrl
     * @return void
     */
    public function setWebserviceUrl($wsUrl)
    {
        $this->wsUrl = $wsUrl;
        $this->client = new SoapClient($this->wsUrl, array('trace' => true));
    }
    
    /**
     * findOneById function.
     * 
     * @access public
     * @param mixed $finder
     * @return void
     */
    public function findOneById($finder)
    {
        return $this->em->getRepository($this->repository)->findOneBy($finder);
    }
    
    /**
     * soapCall function.
     * 
     * @access public
     * @param mixed $method
     * @param mixed $parameters
     * @return void
     */
    public function soapCall($method, $parameters)
    {
        $result = null;
        
        try {
            $result = $this->client->$method($parameters);
        } catch (SoapFault $e) { 
           $this->logger->err($e->getMessage());
        }
        
        return $result;
    }
    
    /**
     * update function.
     * 
     * @access public
     * @param mixed $entity
     * @param bool $persist (default: false)
     * @return void
     */
    public function update($entity, $persist = false)
    {
        if ($persist) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }
    
    /**
     * start function.
     * 
     * @access public
     * @param mixed $method
     * @return void
     */
    public function start($method)
    {
        $msg = $method. ' start';
        $this->timer = microtime(true);
        var_dump($this->timer);
        
        $this->logger->info($msg);
    }
    
    /**
     * end function.
     * 
     * @access public
     * @param mixed $method
     * @return void
     */
    public function end($method)
    {
        $msg = $method. ' end, execution time :'. round(microtime(true) - $this->timer, 2). 's';
        
        $this->logger->info($msg);
    }
    
    public function throwException($msg, $exception)
    {
        $this->logger->critical($msg);
        throw new $exception;
    }
}
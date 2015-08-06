<?php

namespace FDC\SoifBundle\Manager;

use \SoapClient;
use \SoapFault;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

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
     * wsMethod
     * 
     * @var mixed
     * @access private
     */
    private $wsMethod;
    
    /**
     * entityIdKey
     * 
     * @var mixed
     * @access protected
     */
    protected $entityIdKey;
    
    /**
     * soifLogger
     * 
     * @var mixed
     * @access protected
     */
    protected $soifLogger;
    
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
     * setSoifLogger function.
     * 
     * @access public
     * @param mixed $soifLogger
     * @return void
     */
    public function setSoifLogger($soifLogger)
    {
        $this->soifLogger = $soifLogger;
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
     * getLocalesMapper function.
     * 
     * @access public
     * @return void
     */
    public function getLocalesMapper()
    {
        $localesMapper = array(
            'ARE' => 'ar',
            'CHN' => 'cn',
            'ESP' => 'es',
            'FRA' => 'fr',
            'GBR' => 'en',
            'JPN' => 'jp',
            'PRT' => 'pt',
            'RUS' => 'ru'
        );
        
        return $localesMapper;
    }
    
    /**
     * updateRelatedEntity function.
     * 
     * @access public
     * @param mixed $repository
     * @param mixed $result
     * @param mixed $key
     * @param mixed $manager
     * @return void
     */
    public function updateRelatedEntity($repository, $result, $key, $manager)
    {
        if (isset($result->{$key})) {
            // update the related entity
            if ($manager !== null) {
               $manager->updateEntity($result->{$key});
            }
            
            // get the entity and update it
            $entityRelated = $this->em->getRepository($repository)->findOneById($result->{$key});
            if ($entityRelated === null) {
                $this->logger->warning(__METHOD__. ' Entity '. substr(strstr($repository, ':'), 1). ' with id '. $result->{$key}. ' not found');
            }
            
            return $entityRelated;
        } else {
            $this->logger->warning("Key {$key} not found in WS Result");
        }
        
        return null;
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
            
            // create log output
            $content = "Method : {$method}\n";
            $content .= 'Parameters: '. implode(', ', $parameters). "\n";
            $content .= "\n\n";
            $content .= $this->client->__getLastResponse();
            $this->soifLogger->write(date('Y_m_d__H_i_s'). '.log.xml', $content);
        } catch (SoapFault $e) { 
           $this->logger->error($e->getMessage());
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
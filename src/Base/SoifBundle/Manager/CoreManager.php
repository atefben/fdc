<?php

namespace Base\SoifBundle\Manager;

use \DateTime;
use \Exception;
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
 * @company Ohwee
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
    protected $wsUrl;

    /**
     * wsResultKey
     * 
     * @var mixed
     * @access protected
     */
    protected $wsResultKey;

    /**
     * validator
     * 
     * @var mixed
     * @access protected
     */
    protected $validator;
    
    /**
     * wsResultObjectKey
     * 
     * @var mixed
     * @access protected
     */
    protected $wsResultObjectKey;

    /**
     * wsMethod
     * 
     * @var mixed
     * @access private
     */
    protected $wsMethod;
    
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
     * setValidator function.
     * 
     * @access public
     * @param mixed $validator
     * @return void
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
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
            'CHI' => 'cn',
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
     * mimeToExtension function.
     * 
     * @access private
     * @param mixed $mimeType
     * @return void
     */
    public function mimeToExtension($mimeType) {
        switch ($mimeType) {
            case "application/pdf":
                return "pdf";
            case "image/gif":
                return "gif";
            case "image/png":
                return "png";
            case "image/jpeg":
                return "jpg";
            case "image/pjpeg":
                return "jpg";
            default:
                $msg = __METHOD__. " - The mime type {$mimeType} is not supported.";
                $exception = new Exception($msg);
                $this->throwException($msg, $exception);
        }
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
        if (property_exists($result, $key)) {
            // update the related entity
            if ($manager !== null) {
               $manager->getById($result->{$key});
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
    public function soapCall($method, $parameters, $hasResult = true)
    {
        $result = null;
        
        try {
            /** 
             * using keep_alive false to fix the error : 
             * Notice: SoapClient::__doRequest(): send of 766 bytes failed with errno=32 Broken pipe
             * https://bugs.php.net/bug.php?id=60329
             */
            $parameters['keep_alive'] = false;
            $this->logger->info('SOIF call: '. $method. ', params: '. implode(', ', $parameters));
            $result = $this->client->$method($parameters);
            // create log output
            $content = "Method : {$method}\n";
            $content .= 'Parameters: '. implode(', ', $parameters). "\n";
            $content .= "\n\n";
            $content .= $this->client->__getLastResponse();
            $this->soifLogger->write(date('Y_m_d__H_i_s'). '__'. $method. '_'. reset($parameters). '.log.xml', $content);
            
            // check the object properties
            $resultObject = ($this->wsResultObjectKey === null) ? $result->{$this->wsResultKey} : $result->{$this->wsResultKey}->Resultats;
            if ($hasResult == true && 
                (!isset($resultObject) || ($this->wsResultObjectKey !== null && !property_exists($resultObject, $this->wsResultObjectKey)))) {
                $msg = __METHOD__. " failed to parse results for {$method} ". implode(',', $parameters);
                $exception = new \Exception($msg);
                $this->throwException($msg, $exception);
            }
        } catch (SoapFault $e) { 
           $this->logger->error($e->getMessage());
        }
        
        return $result;
    }
    
    /**
     * setSoifUpdatedAt function.
     * 
     * @access public
     * @param mixed $result
     * @param mixed $entity
     * @return void
     */
    public function setSoifUpdatedAt($result, $entity)
    {
        if (!property_exists($result->{$this->wsResultKey}, 'DateDerniereModification')) {
            $this->logger->warning(__METHOD__. ' DateDerniereModification not found in WS Result');
        } else {
            $soifUpdatedAt = new \DateTime($result->{$this->wsResultKey}->DateDerniereModification);
            $entity->setSoifUpdatedAt($soifUpdatedAt);
        }
    }
    
    /**
     * setEntityProperties function.
     * 
     * @access public
     * @param mixed $result
     * @param mixed $entity
     * @return void
     */
    public function setEntityProperties($result, $entity)
    {
        foreach ($this->mapper as $setter => $soapKey) {
            if (!property_exists($result, $soapKey)) {
                $this->logger->warning(__METHOD__. ' Key '. $soapKey. ' not found in WS Result');
                continue;
            }
            
            if (!method_exists($entity, $setter)) {
                $this->logger->warning(__METHOD__. ' Method '. $setter. ' not found in Entity '. get_class($entity));
                continue;
            }
            $result->{$soapKey} = (strpos($soapKey, 'Date') === false) ? $result->{$soapKey} : new DateTime($result->{$soapKey});
            $entity->{$setter}($result->{$soapKey});
        }
    }

    /**
     * setEntityRelated function.
     * 
     * @access public
     * @param mixed $result
     * @param mixed $entity
     * @return void
     */
    public function setEntityRelated($result, $entity)
    {
        foreach ($this->mapperEntity as $property) {
            $property['manager'] = ($property['manager'] !== null) ? $property['manager'] : null;
            $entityRelated = $this->updateRelatedEntity($property['repository'], $result, $property['soapKey'], $property['manager']);
            if ($entityRelated !== null) {
                $entity->{$property['setter']}($entityRelated);
            }
        }
    }
    
    /**
     * setEntityTranslations function.
     * 
     * @access public
     * @param mixed $result
     * @param mixed $entity
     * @param mixed $entityTranslationNew
     * @return void
     */
    public function setEntityTranslations($result, $entity, $entityTranslationNew)
    {
        $localesMapper = $this->getLocalesMapper();
        foreach ($this->mapperTranslations as $key => $mapper) {
            if (!property_exists($result, $key) || !isset($result->{$key}) ||
                !property_exists($result->{$key}, $mapper['result'])) {
                $msg = __METHOD__. " {$key} / {$mapper['result']} not found";
                $this->logger->warning($msg);
                continue;
            }
            
            $translations = $result->{$key}->{$mapper['result']};
            
            // new translation mapper version
            if (isset($mapper['setters'])) {
                $translations = $this->mixedToArray($translations);
                foreach ($translations as $translation) {
                    // the iso field has different name in GetMovie it's IdLangue, other ws CodeLangue.
                    $iso = (isset($mapper['wsLangKey'])) ? $translation->$mapper['wsLangKey'] : ((property_exists($translation, 'CodeLangue')) ? $translation->CodeLangue : $translation->IdLangue);
                    if (!isset($localesMapper[$iso])) {
                        $this->logger->warning(__METHOD__. " the locales mapper {$iso} doesn't exist");
                        continue;
                    }
                    if (!isset($entityTranslation[$iso])) {
                        $entityTranslation[$iso] = $entity->findTranslationByLocale($localesMapper[$iso]);
                    }
                    $entityTranslation[$iso] = ($entityTranslation[$iso] !== null) ? $entityTranslation[$iso] : clone $entityTranslationNew;
                    foreach ($mapper['setters'] as $setter => $wsKey) {
                        $entityTranslation[$iso]->{$setter}($translation->{$wsKey});
                    }
                    $entityTranslation[$iso]->setLocale($localesMapper[$iso]);
                    if ($entityTranslation[$iso]->getId() === null) {
                        $entity->addTranslation($entityTranslation[$iso]);
                    }
                }
            } // old translation mapper version, @TODO: update manager constructor to use the new mapper version
            else  {
                foreach ($translations as $translation) {
                    // the iso field has different name in GetMovie it's IdLangue, other ws CodeLangue.
                    $iso = (isset($mapper['wsLangKey'])) ? $translation->$mapper['wsLangKey'] : ((property_exists($translation, 'CodeLangue')) ? $translation->CodeLangue : $translation->IdLangue);
                    if (!isset($localesMapper[$iso])) {
                        $this->logger->warning(__METHOD__. " the locales mapper {$iso} doesn't exist");
                        continue;
                    }

                    if (!isset($entityTranslation[$iso])) {
                        $entityTranslation[$iso] = $entity->findTranslationByLocale($localesMapper[$iso]);
                    }
                    $entityTranslation[$iso] = ($entityTranslation[$iso] !== null) ? $entityTranslation[$iso] : clone $entityTranslationNew;
                    $entityTranslation[$iso]->{$mapper['setter']}($translation->{$mapper['wsKey']});
                    $entityTranslation[$iso]->setLocale($localesMapper[$iso]);
                    if ($entityTranslation[$iso]->getId() === null) {
                        $entity->addTranslation($entityTranslation[$iso]);
                    }
                }
            }
        }
    }
    
    /**
     * setEntityRelatedTranslations function.
     * 
     * @access public
     * @param mixed $result
     * @param mixed $entity
     * @return void
     */
    public function setEntityRelatedTranslations($result, $entity)
    {
        $localesMapper = $this->getLocalesMapper();
        foreach ($this->mapperEntityTranslations as $key => $mapper) {
            $entityTranslation = array();

            // check isset translations
            if (!property_exists($result, $key) || !property_exists($result->{$key}->Traductions, $mapper['result'])) {
                $msg = __METHOD__. " {$key} / {$mapper['result']} not found";
                $this->logger->warning($msg);
                continue;
            }
            // get related entity
            $translations = $result->{$key}->Traductions->{$mapper['result']};
            $identifier = (isset($mapper['wsIdentifier'])) ? $mapper['wsIdentifier'] : 'Id';
            $entityRelated = $this->em->getRepository($mapper['repository'])->findOneBy(array('id' => $result->{$key}->{$identifier}));
            $entityRelated = ($entityRelated !== null) ? $entityRelated : clone $mapper['entity'];
            if ($entityRelated->getId() === null) {
                $entityRelated->setId($result->{$key}->{$identifier});
            }
            $entity->{$mapper['setter']}($entityRelated);
            
            // loop throught translations
            foreach ($translations as $translation) {
                if (!isset($localesMapper[$translation->CodeLangue])) {
                    $this->logger->warning(__METHOD__. " the locales mapper {$translation->CodeLangue} doesn't exist");
                    continue;
                }
                if (!isset($entityTranslation[$translation->CodeLangue])) {
                    $entityTranslation[$translation->CodeLangue] = $entityRelated->findTranslationByLocale($localesMapper[$translation->CodeLangue]);
                }
                
                // set translations
                $entityTranslation[$translation->CodeLangue] = ($entityTranslation[$translation->CodeLangue] !== null) ? $entityTranslation[$translation->CodeLangue] : clone $mapper['entityTranslation'];
                $entityTranslation[$translation->CodeLangue]->{$mapper['setterTranslation']}($translation->{$mapper['wsKey']});
                $entityTranslation[$translation->CodeLangue]->setLocale($localesMapper[$translation->CodeLangue]);
                
                // if new entity add translation to parent
                if ($entityTranslation[$translation->CodeLangue]->getId() === null) {
                    $entityRelated->addTranslation($entityTranslation[$translation->CodeLangue]);
                }
            }
        }
    }

    /**
     * update function.
     * 
     * @access public
     * @param mixed $entity
     * @return void
     */
    public function update($entity)
    {
        // if is new, persist entity
        if ($entity->getCreatedAt() === null) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }
    

    /**
     * remove function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     */
    public function remove($id)
    {
        $entity = $this->em->getRepository($this->repository)->findOneBy(array('id' => $id));
        if ($entity !== null) {
            $this->em->remove($entity);
        } else {
            $this->logger->info("{$this->repository} #{$id} can't be removed because it doesn't exist");
        }
    }
    
    /**
     * updateMultiple function.
     * 
     * @access public
     * @param mixed $entities
     * @return void
     */
    public function updateMultiple($entities)
    {
        foreach ($entities as $entity) {
            // if is new, persist entity
            if ($entity->getCreatedAt() === null) {
                $this->em->persist($entity);
            }
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
    
    /**
     * throwException function.
     * 
     * @access public
     * @param mixed $msg
     * @param mixed $exception
     * @return void
     */
    public function throwException($msg, $exception)
    {
        $this->logger->critical($msg);
     //   throw new $exception;
    }
    
    /**
     * removeOldRelations function.
     * 
     * @access public
     * @param mixed $collectionOld
     * @param mixed $collectionNew
     * @param mixed $entity
     * @param mixed $remover
     * @return void
     */
    public function removeOldRelations($collectionOld, $collectionNew, $entity, $remover)
    {
        foreach ($collectionOld as $obj) {
            if (!$collectionNew->contains($obj)) {
                $this->logger->info('deleted obj :'. $obj->getId());
                $this->logger->info(get_class($obj));
                $entity->{$remover}($obj);
            }
        }
    }

    /**
     * mixedToArray function.
     * 
     * @access public
     * @param mixed $mixed
     * @return void
     */
    public function mixedToArray($mixed)
    {
        if (gettype($mixed) !== 'array') {
            $mixed = array($mixed);
        }
        
        return $mixed;
    }
    
    /**
     * deleteMultiple function.
     * 
     * @access public
     * @param mixed $objects
     * @return void
     */
    public function deleteMultiple($objects)
    {
        // loop 3 times because results are returned that way
        foreach ($objects as $types) {
            foreach ($types as $ids) {
                // make sure we have an array even when one single result is returned
                $ids = $this->mixedToArray($ids);
                foreach ($ids as $id) {
                    $this->remove($id);
                }
            }
        }
    }
}
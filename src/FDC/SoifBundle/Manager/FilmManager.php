<?php

namespace FDC\SoifBundle\Manager;

use FDC\CoreBundle\Entity\FilmFilm;
use FDC\CoreBundle\Entity\FilmFilmCountry;

/**
 * FilmManager class.
 * 
 * @extends CoreManager
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class FilmManager extends CoreManager
{
    /**
     * festivalManager
     * 
     * @var mixed
     * @access private
     */
    private $festivalManager;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($festivalManager)
    {
        $this->festivalManager = $festivalManager;
        $this->repository = 'FDCCoreBundle:FilmFilm';
        $this->wsParameterKey = 'idFilm';
        $this->wsMethod = 'GetMovie';
        $this->wsResultKey = 'GetMovieResult';
        $this->wsResultObjectKey = 'FilmDto';
        $this->entityIdKey = 'Id';
        $this->mapper = array(
            'setId' => $this->entityIdKey,
            'setDirectorFirst' => 'EstPremierFilm',
            'setRestored' => 'EstRestaure',
            'setTitleVO' => 'TitreOriginal',
            'setTitleVOAlphabet' => 'TitreOriginalAlphabetOriginal',
            'setProductionYear' => 'AnneeDeProduction',
            'setDuration' => 'Duree',
            'setWebsite' => 'SiteWeb',
            'setCastingCommentary' => 'CommentaireCasting',
            'setGalaId' => 'IdGala',
            'setGalaName' => 'NomGala'
        );
        // @todo: titre francais / titre anglais - gala - 
        $this->mapperEntity = array(
            array(
                'repository' => 'FDCCoreBundle:FilmFestival',
                'soapKey' => 'IdFestival',
                'setter' => 'setFestival',
                'manager' => $this->festivalManager
            )
        );
    }
    
    /**
     * updateEntity function.
     * 
     * @access public
     * @param mixed $id
     * @return void
     */
    public function updateEntity($id)
    {
        // start timer
        $this->start(__METHOD__);

        // call the ws
        $result = $this->soapCall($this->wsMethod, array($this->wsParameterKey => $id));
        $resultObject = $result->{$this->wsResultKey}->Resultats->{$this->wsResultObjectKey};
        var_dump($result);

        // create / get entity
        $entity = ($this->findOneById(array('id' => $resultObject->{$this->entityIdKey}))) ?: new FilmFilm();
        $persist = ($entity->getId() === null) ? true : false;

        // set soif last update time
        $this->setSoifUpdatedAt($result, $entity);
        
        // set entity properties
        $this->setEntityProperties($resultObject, $entity);
        
        // set related entity
        $this->setEntityRelated($resultObject, $entity);
        
        // set film production country
        if (!property_exists($resultObject, 'FilmPaysProduction') || !property_exists($resultObject->FilmPaysProduction, 'PaysProductionDto')) {
            $this->logger->warning(__METHOD__. " {$id} FilmPaysProduction not found");
        } else {
            // create an array when we get an object to standardize the code
            if (gettype($resultObject->FilmPaysProduction->PaysProductionDto) == 'object') {
                $resultObject->FilmPaysProduction->PaysProductionDto = array($resultObject->FilmPaysProduction->PaysProductionDto);
            }
            
            $entityRelated = new FilmFilmCountry();
            foreach ($resultObject->FilmPaysProduction->PaysProductionDto as $filmProdCountry) {
               // $entity->setCountry()
               //s $entity->setposition
                var_dump($filmProdCountry);
             //   var_dump($filmProdCountry->CodeIso);
            }
        }
        
        // update entity
        $this->update($entity, $persist);
        
        // end timer
        $this->end(__METHOD__);
    }
}
<?php

declare(strict_types=1);

namespace Domain\Manager;

use InFileSystemPersistence;

/**
 * Class PictureManager
 * This class acts as The middleware between Database (simulated by the class InFileSystemPersistence) and Controllers.
 */
final class PictureManager
{
    private InFileSystemPersistence $ifsp;

    
    /**
     * The constructor of PictureManager
     * @param mixed $ifspParam The Database Reference
     */
    public function __construct($ifspParam){
        $this->ifsp = $ifspParam;
    }
    
    
    /**     
     * Return all the pictures in Database
     * @return Array[PictureDTO]
     */
    public function getPictures(){
        return $this->ifsp->getPictures();
    }

    /**
     * Returns an specific Picture depending on its id
     * @param mixed $idA The id of the Picture
     * @return PictureDTO
     */
    public function getPictureById($idP){
        return $this->ifsp->getPictures()[$idP-1];
    }

    /**
     * Returns all pictures of an specific add selected by its id
     * @param mixed $idAd The id of the Ad
     * @param mixed $adManager it needs the AdManager in order to find all the pictures of an Ad
     * @return Array[PictureDTO]
     */
    public function getPicturesByAdId($idAd, $adManager){
        $picturesNew = [];

        $picturesAd = $adManager->getAdById($idAd)->getPictures();
        foreach($picturesAd as $idP){
            array_push($picturesNew, $this->getPictureById($idP));
        }

        return $picturesNew;
    }
}
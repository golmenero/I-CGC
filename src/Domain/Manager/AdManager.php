<?php

declare(strict_types=1);

namespace Domain\Manager;

use InFileSystemPersistence;

/**
 * Class AdManager
 * This class acts as The middleware between Database (simulated by the class InFileSystemPersistence) and Controllers.
 */
final class AdManager
{
    private InFileSystemPersistence $ifsp;

    /**
     * The constructor of ADManager
     * @param mixed $ifspParam The Database Reference
     */
    public function __construct($ifspParam){
        $this->ifsp = $ifspParam;
    }

    /**
     * Return all the ads in Database
     * @return Array[AdDTO]
     */
    public function getAds(){
        return $this->ifsp->getAds();
    }

    /**
     * Returns an specific Ad depending on its id
     * @param mixed $idA The id of the Ad
     * @return AdDTO
     */
    public function getAdById($idA){
        return $this->ifsp->getAds()[$idA-1];
    }

    /**
     * Returns all the ads, but their parameter 'pictures' is an Array of PictureDTO, instead of integers
     * @param mixed $pictureManager it needs the PictureManager in order to find all the pictures of an Ad
     * @return Array[AdDTO]
     */
    public function getAdsExtended($pictureManager){
        $ads = $this->ifsp->getAds();

        foreach($ads as $ad){
            $ad->setPictures($pictureManager->getPicturesByAdId($ad->getId(), $this));
        }

        return $ads;
    }


}

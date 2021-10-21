<?php

declare(strict_types=1);

namespace Domain\Manager;

use InFileSystemPersistence;
use DateTimeImmutable;

final class PictureManager
{
    private InFileSystemPersistence $ifsp;

    public function __construct($ifspParam){
        $this->ifsp = $ifspParam;
    }
    
    public function getPictures(){
        return $this->ifsp->getPictures();
    }

    public function getPictureById($idP){
        return $this->ifsp->getPictures()[$idP-1];
    }

    public function getPicturesByAdId($idAd, $adManager){
        $picturesNew = [];

        $picturesAd = $adManager->getAdById($idAd)->getPictures();
        foreach($picturesAd as $idP){
            array_push($picturesNew, $this->getPictureById($idP));
        }

        return $picturesNew;
    }
}
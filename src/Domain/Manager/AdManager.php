<?php

declare(strict_types=1);

namespace App\Domain\Manager;

use App\Infrastructure\Persistence\InFileSystemPersistence;
use DateTimeImmutable;

final class AdManager
{
    private InFileSystemPersistence $ifsp;

    public function __construct($ifspParam){
        $this->ifsp = $ifspParam;
    }

    public function getAds(){
        return $this->ifsp->getAds();
    }

    public function getAdById($idA){
        return $this->ifsp->getAds()[$idA-1];
    }

    public function getAdsExtended($pictureManager){
        $ads = $this->ifsp->getAds();

        foreach($ads as $ad){
            $ad->pictures = $pictureManager->getPicturesByAdId($ad->id, $this);
        }

        return $ads;
    }


}

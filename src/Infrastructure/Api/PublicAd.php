<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

final class PublicAd
{
    public function __construct($id, $typology, $description, $pictureUrls, $houseSize, $gardenSize)
    {
        $this->id = $id;
        $this->typology=$typology;
        $this->description=$description;
        $this->pictureUrls=$pictureUrls;
        $this->houseSize=$houseSize;
        $this->gardenSize=$gardenSize;
    }
}

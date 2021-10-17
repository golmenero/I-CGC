<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use DateTimeImmutable;

final class QualityAd
{
    public function __construct($id, $typology, $description, $pictureUrls, $houseSize, $gardenSize, $score, $irrelevantSince)
    {
        $this->id = $id;
        $this->typology=$typology;
        $this->description=$description;
        $this->pictureUrls=$pictureUrls;
        $this->houseSize=$houseSize;
        $this->gardenSize=$gardenSize;
        $this->score=$score;
        $this->irrelevantSince=$irrelevantSince;
    }
}

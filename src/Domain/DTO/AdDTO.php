<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;

final class AdDTO
{
    public function __construct($id, $typology, $description, $pictures, $houseSize, $gardenSize, $score, $irrelevantSince)
    {
        $this->id = $id;
        $this->typology = $typology;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->houseSize = $houseSize;
        $this->gardenSize = $gardenSize;
        $this->score = $score;
        $this->irrelevantSince = $irrelevantSince;
    }

    public function getPictures(){
        return $this->pictures;
    }
}

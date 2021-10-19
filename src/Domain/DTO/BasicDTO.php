<?php

declare(strict_types=1);

namespace App\Domain;

final class BasicDTO
{
    public int $points = 0;

    public function getPoints(){
        return $this->points;
    }

    public function setPoints($newP){
        $this->points = $newP;
    }
}

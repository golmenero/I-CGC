<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use DateTimeImmutable;

final class AdDTO
{
    private int $id;
    private String $typology;
    private String $description;
    private array $pictures;
    private int $houseSize;
    private ?int $gardenSize = null;
    private ?int $score = null;
    private ?DateTimeImmutable $irrelevantSince = null;

    private int $points;


    public function __construct($id, $typology, $description, $pictures, $houseSize, $gardenSize, $score, $irrelevantSince)
    {
        $this->points = 0;
        $this->id = $id;
        $this->typology = $typology;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->houseSize = $houseSize;
        $this->gardenSize = $gardenSize;
        $this->score = $score;
        $this->irrelevantSince = $irrelevantSince;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($idP)
    {
        $this->id = $idP;
    }

    public function getTypology()
    {
        return $this->typology;
    }

    public function setTypology($typologyP)
    {
        $this->typology = $typologyP;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($descriptionP)
    {
        $this->description = $descriptionP;
    }

    public function getPictures()
    {
        return $this->pictures;
    }

    public function setPictures($picturesP)
    {
        $this->pictures = $picturesP;
    }

    public function getHouseSize()
    {
        return $this->houseSize;
    }

    public function setHouseSize($houseSizeP)
    {
        $this->houseSize = $houseSizeP;
    }

    public function getGardenSize()
    {
        return $this->gardenSize;
    }

    public function setGardenSize($gardenSizeP)
    {
        $this->gardenSize = $gardenSizeP;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($scoreP)
    {
        $this->score = $scoreP;
    }

    public function getIrrelevantSince()
    {
        return $this->irrelevantSince;
    }

    public function setIrrelevantSince($irrelevantSinceP)
    {
        $this->irrelevantSince = $irrelevantSinceP;
    }


    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($newP)
    {
        $this->points = $newP;
    }

    public function increasePoints($newP)
    {
        $this->points += $newP;
    }
}

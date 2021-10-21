<?php

declare(strict_types=1);

namespace Domain\DTO;

use DateTimeImmutable;

/**
 * Class AdDTO
 * This is the DTO (Data Transfer Object) for the Ad Object
 */
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


    /**
     * Constructor of the class AdDTO 
     * @param int $id
     * @param String $typology
     * @param String $description
     * @param array $pictures
     * @param int $houseSize
     * @param int $gardenSize
     * @param int $score
     * @param DateTimeImmutable $irrelevantSince
     */
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

    /**
     * Getter for the parameter Id in class AdDTO
     * @return int ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for the parameter Id in class AdDTO
     * @param int $idP The new Id
     */
    public function setId($idP)
    {
        $this->id = $idP;
    }

    /**
     * Getter for the parameter Typology in class AdDTO
     * @return String typology
     */
    public function getTypology()
    {
        return $this->typology;
    }

    /**
     * Setter for the parameter Typology in class AdDTO
     * @param String $typologyP The new Typology
     */
    public function setTypology($typologyP)
    {
        $this->typology = $typologyP;
    }

    /**
     * Getter for the parameter Description in class AdDTO
     * @return String description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Setter for the parameter Description in class AdDTO
     * @param String $descriptionP The new Description
     */
    public function setDescription($descriptionP)
    {
        $this->description = $descriptionP;
    }

    /**
     * Getter for the parameter Pictures in class AdDTO
     * @return Array[int] pictures
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Setter for the parameter Pictures in class AdDTO
     * @param Array[int] $picturesP The new Pictures
     */
    public function setPictures($picturesP)
    {
        $this->pictures = $picturesP;
    }

    /**
     * Getter for the parameter HouseSize in class AdDTO
     * @return int houseSize
     */
    public function getHouseSize()
    {
        return $this->houseSize;
    }

    /**
     * Setter for the parameter HouseSize in class AdDTO
     * @param int $houseSizeP The new houseSize
     */
    public function setHouseSize($houseSizeP)
    {
        $this->houseSize = $houseSizeP;
    }

    /**
     * Getter for the parameter GardenSize in class AdDTO
     * @return int gardenSize
     */
    public function getGardenSize()
    {
        return $this->gardenSize;
    }

    /**
     * Setter for the parameter GardenSize in class AdDTO
     * @param int $gardenSizeP The new gardenSize
     */
    public function setGardenSize($gardenSizeP)
    {
        $this->gardenSize = $gardenSizeP;
    }

    /**
     * Getter for the parameter Score in class AdDTO
     * @return int score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Setter for the parameter Score in class AdDTO
     * @param int $scoreP The new score
     */
    public function setScore($scoreP)
    {
        $this->score = $scoreP;
    }

    /**
     * Getter for the parameter IrrelevantSince in class AdDTO
     * @return DateTimeImmutable irrelevantSince
     */
    public function getIrrelevantSince()
    {
        return $this->irrelevantSince;
    }

    /**
     * Setter for the parameter irrelevantSince in class AdDTO
     * @param DateTimeImmutable $irrelevantSinceP The new irrelevantSince
     */
    public function setIrrelevantSince($irrelevantSinceP)
    {
        $this->irrelevantSince = $irrelevantSinceP;
    }

    /**
     * Getter for the parameter Points in class AdDTO
     * @return int points
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Setter for the parameter Score in class AdDTO
     * @param int $scoreP The new score
     */
    public function setPoints($newP)
    {
        $this->points = $newP;
    }

    /**
     * This function updates the points of the object AdDTO
     * @param int $newP The number of points to update
     */
    public function increasePoints($newP)
    {
        $this->points += $newP;
    }
}

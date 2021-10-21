<?php

declare(strict_types=1);

namespace Domain\DTO;

/**
 * Class PictureDTO
 * This is the DTO (Data Transfer Object) for the Picture Object
 */
final class PictureDTO
{
    private int $id;
    private String $url;
    private String $quality;

    /**
     * Constructor of the class PictureDTO
     * @param int $id
     * @param String $url
     * @param String $quality
     */
    public function __construct($id, $url, $quality)
    {
        $this->id = $id;
        $this->url = $url;
        $this->quality = $quality;
    }

    /**
     * Getter for the parameter Id in class PictureDTO
     * @return int ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for the parameter Id in class PictureDTO
     * @param int $idP The new Id
     */
    public function setId($idP)
    {
        $this->id = $idP;
    }

    /**
     * Getter for the parameter Url in class PictureDTO
     * @return String url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Setter for the parameter Url in class PictureDTO
     * @param String $urlP The new url
     */
    public function setUrl($urlP)
    {
        $this->url = $urlP;
    }

    /**
     * Getter for the parameter Quality in class PictureDTO
     * @return String quality
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Setter for the parameter Quality in class PictureDTO
     * @param String $qualityP The new quality
     */
    public function setQuality($qualityP)
    {
        $this->quality = $qualityP;
    }
}

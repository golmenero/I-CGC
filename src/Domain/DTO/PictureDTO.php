<?php

declare(strict_types=1);

namespace App\Domain\DTO;

final class PictureDTO
{
    private int $id;
    private String $url;
    private String $quality;

    public function __construct($id, $url, $quality)
    {
        $this->id = $id;
        $this->url = $url;
        $this->quality = $quality;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($idP)
    {
        $this->id = $idP;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($urlP)
    {
        $this->url = $urlP;
    }

    public function getQuality()
    {
        return $this->quality;
    }

    public function setQuality($qualityP)
    {
        $this->quality = $qualityP;
    }
}

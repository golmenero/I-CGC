<?php

declare(strict_types=1);

namespace App\Domain\DTO;

final class PictureDTO
{
    public function __construct( $id, $url, $quality) {
        $this->id = $id;
        $this->url = $url;
        $this->quality = $quality;
    }
}

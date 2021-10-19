<?php

declare(strict_types=1);

namespace App\Domain;

final class PictureDTO extends BasicDTO
{
    public function __construct( $id, $url, $quality) {
        $this->id = $id;
        $this->url = $url;
        $this->quality = $quality;
    }
}

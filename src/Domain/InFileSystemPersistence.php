<?php 

declare(strict_types=1);

use Domain\DTO\AdDTO;
use Domain\DTO\PictureDTO;

/**
 * Class InFileSystemPersistence
 * This class acts as a Database for the System
 */
final class InFileSystemPersistence
{
    private array $ads;
    private array $pictures;

    /**
     * Constructor for the class InFileSystemPersistence
     */
    public function __construct()
    {
        $this->ads = array(
            new AdDTO(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null),
            new AdDTO(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, null, null),
            new AdDTO(3, 'CHALET', '', [2], 300, null, null, null),
            new AdDTO(4, 'FLAT', 'Ático céntrico muy luminoso y recién reformado, parece nuevo', [5], 300, null, null, null),
            new AdDTO(5, 'FLAT', 'Pisazo,', [3, 8], 300, null, null, null),
            new AdDTO(6, 'GARAGE', '', [6], 300, null, null, null),
            new AdDTO(7, 'GARAGE', 'Garaje en el centro de Albacete', [], 300, null, null, null),
            new AdDTO(8, 'CHALET', 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', [1, 7], 300, null, null, null)
        );

        $this->pictures = array(
            new PictureDTO(1, 'https://www.idealista.com/pictures/1', 'SD'),
            new PictureDTO(2, 'https://www.idealista.com/pictures/2', 'HD'),
            new PictureDTO(3, 'https://www.idealista.com/pictures/3', 'SD'),
            new PictureDTO(4, 'https://www.idealista.com/pictures/4', 'HD'),
            new PictureDTO(5, 'https://www.idealista.com/pictures/5', 'SD'),
            new PictureDTO(6, 'https://www.idealista.com/pictures/6', 'SD'),
            new PictureDTO(7, 'https://www.idealista.com/pictures/7', 'SD'),
            new PictureDTO(8, 'https://www.idealista.com/pictures/8', 'HD')
        );
    }

    /**
     * Returns the Array of Ads
     * @return Array[AdDTO]
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * Returns the Array of Pictures
     * @return Array[PictureDTO]
     */
    public function getPictures()
    {
        return $this->pictures;
    }

}

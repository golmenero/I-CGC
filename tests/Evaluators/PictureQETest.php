<?php

use Domain\DTO\AdDTO;
use Domain\DTO\PictureDTO;
use Domain\Evaluation\Evaluators\PictureQE;
use PHPUnit\Framework\TestCase;


/**
 * TestCase PictureQETest
 * Evaluates The Class PictureQE
 */
class PictureQETest extends TestCase
{

    private $pictureQE;
    private $adDTO, $adDTO1, $adDTO2, $adDTO3, $adDTO4, $adDTO5;

    public function setUp(): void
    {
        $this->pictureQE = new PictureQE();

        $pDTO1 = new PictureDTO(1, 'https://www.idealista.com/pictures/1', 'SD');
        $pDTO2 = new PictureDTO(2, 'https://www.idealista.com/pictures/2', 'HD');
        $pDTO3 = new PictureDTO(3, 'https://www.idealista.com/pictures/3', 'SD');
        $pDTO4 = new PictureDTO(4, 'https://www.idealista.com/pictures/4', 'HD');

        $this->adDTO = new AdDTO(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null);
        $this->adDTO1 = new AdDTO(2, 'FLAT', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [$pDTO2], 300, null, null, null);
        $this->adDTO2 = new AdDTO(3, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [$pDTO1], 300, null, null, null);
        $this->adDTO3 = new AdDTO(4, 'GARAGE', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [$pDTO2, $pDTO4], 300, null, null, null);
        $this->adDTO4 = new AdDTO(5, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [$pDTO1, $pDTO3], 300, null, null, null);
        $this->adDTO5 = new AdDTO(6, 'FLAT', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [$pDTO1, $pDTO2, $pDTO3, $pDTO4], 300, null, null, null);
    }

    /**
     * Test an Ad with 0 Pictures
     */
    public function testZeroPictures(): void
    {
        $this->pictureQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), -10);
    }

    /**
     * Test an Ad with one HD Picture
     */
    public function testOneHdPicture(): void
    {
        $this->pictureQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 20);
    }

    /**
     * Test an Ad with one SD Picture
     */
    public function testOneSdPicture(): void
    {
        $this->pictureQE->evaluate($this->adDTO2);
        $this->assertEquals($this->adDTO2->getPoints(), 10);
    }

    /**
     * Test an Ad with multiple HD Pictures
     */
    public function testMultipleHdPictures(): void
    {
        $this->pictureQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 40);
    }

    /**
     * Test an Ad with multiple SD Pictures
     */
    public function testMultipleSdPictures(): void
    {
        $this->pictureQE->evaluate($this->adDTO4);
        $this->assertEquals($this->adDTO4->getPoints(), 20);
    }

    /**
     * Test an Ad with mixed Pictures (HD and SD)
     */
    public function testMixedPictures(): void
    {
        $this->pictureQE->evaluate($this->adDTO5);
        $this->assertEquals($this->adDTO5->getPoints(), 60);
    }
}

<?php

use Domain\DTO\AdDTO;
use Domain\Evaluation\Evaluators\PictureQE;
use PHPUnit\Framework\TestCase;


class PictureQETest extends TestCase{

    private $pictureQE;
    private $adDTO;

    public function setUp():void {
        $this->pictureQE = new PictureQE();
        $this->adDTO = new AdDTO(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null);
    }

    public function testPointsIfLessThanZero():void {
        $this->pictureQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), -10);
    }


    //fwrite(STDERR, print_r($this->adDTO, TRUE));
}
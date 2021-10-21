<?php

use Domain\DTO\AdDTO;
use Domain\DTO\PictureDTO;
use Domain\Evaluation\Evaluators\CompleteAdQE;
use PHPUnit\Framework\TestCase;


/**
 * TestCase CompleteAdQETest
 * Evaluates The Class CompleteAdQE
 */
class CompleteAdQETest extends TestCase
{

    private $completeAdQE;
    private $pDTO;
    private $adDTO, $adDTO1, $adDTO2, $adDTO3, $adDTO4, $adDTO5;

    public function setUp(): void
    {
        $this->completeAdQE = new CompleteAdQE();

        $this->pDTO = new PictureDTO(1, 'https://www.idealista.com/pictures/1', 'SD');

        $this->adDTO = new AdDTO(1, 'CHALET', 'Este Chalet Esta Completo', [$this->pDTO], 300, 100, null, null);
        $this->adDTO1 = new AdDTO(1, 'FLAT', 'Este Piso Esta Completo', [$this->pDTO], 300, 0, null, null);
        $this->adDTO2 = new AdDTO(1, 'GARAGE', 'Este Garaje Esta Completo', [$this->pDTO], 0, null, null, null);

        $this->adDTO3 = new AdDTO(1, 'CHALET', '', [], 0, null, null, null);
        $this->adDTO4 = new AdDTO(1, 'FLAT', '', [], 0, null, null, null);
        $this->adDTO5 = new AdDTO(1, 'GARAGE', '', [], 0, null, null, null);
    }

    /**
     * Test if an Ad is complete or not 
     */
    public function testComplete(): void
    {
        // CHALET
        $this->completeAdQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 40);

        // FLAT
        $this->completeAdQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 40);

        // GARAGE
        $this->completeAdQE->evaluate($this->adDTO2);
        $this->assertEquals($this->adDTO2->getPoints(), 40);
    }

    /**
     * Test if a Chalet is complete or not 
     */
    public function testChaletInComplete(): void
    {
        // It should be incomplete until all the necessary attributes exist.
        $this->completeAdQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 0);

        $this->adDTO3->setDescription("Description test");
        $this->completeAdQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 0);

        $this->adDTO3->setPictures([$this->pDTO]);
        $this->completeAdQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 0);

        $this->adDTO3->setHouseSize(100);
        $this->completeAdQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 0);

        // Now the CHALET should be complete
        $this->adDTO3->setGardenSize(50);
        $this->completeAdQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 40);
    }

    /**
     * Test if a Flat is complete or not 
     */
    public function testFlatInComplete(): void
    {
        // It should be incomplete until all the necessary attributes exist.
        $this->completeAdQE->evaluate($this->adDTO4);
        $this->assertEquals($this->adDTO4->getPoints(), 0);

        $this->adDTO4->setDescription("Description test");
        $this->completeAdQE->evaluate($this->adDTO4);
        $this->assertEquals($this->adDTO4->getPoints(), 0);

        $this->adDTO4->setPictures([$this->pDTO]);
        $this->completeAdQE->evaluate($this->adDTO4);
        $this->assertEquals($this->adDTO4->getPoints(), 0);

        // Now the FLAT should be complete
        $this->adDTO4->setHouseSize(100);
        $this->completeAdQE->evaluate($this->adDTO4);
        $this->assertEquals($this->adDTO4->getPoints(), 40);
    }

    /**
     * Test if a Garage is complete or not 
     */
    public function testGarageInComplete(): void
    {
        // It should be incomplete until all the necessary attributes exist.
        $this->completeAdQE->evaluate($this->adDTO5);
        $this->assertEquals($this->adDTO5->getPoints(), 0);

        $this->adDTO5->setDescription("Description test");
        $this->completeAdQE->evaluate($this->adDTO5);
        $this->assertEquals($this->adDTO5->getPoints(), 0);

        // Now the GARAGE should be complete
        $this->adDTO5->setPictures([$this->pDTO]);
        $this->completeAdQE->evaluate($this->adDTO5);
        $this->assertEquals($this->adDTO5->getPoints(), 40);
    }
}

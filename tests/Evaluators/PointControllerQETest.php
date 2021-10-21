<?php

use Domain\DTO\AdDTO;
use Domain\DTO\PictureDTO;
use Domain\Evaluation\Evaluators\CompleteAdQE;
use Domain\Evaluation\Evaluators\PointControllerQE;
use PHPUnit\Framework\TestCase;


/**
 * TestCase PointControllerQETest
 * Evaluates The Class PointControllerQE
 */
class PointControllerQETest extends TestCase
{

    private $pointControllerQE;
    private $adDTO;

    public function setUp(): void
    {
        $this->pointControllerQE = new PointControllerQE();

        $this->adDTO = new AdDTO(1, 'CHALET', 'Este Chalet Esta Completo', [], 300, 100, null, null);
    }

    /**
     * Test if the Evaluator doesnt change the points when in range
     */
    public function testPointsCorrect(): void
    {
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);

        $this->adDTO->setPoints(100);
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 100);

        $this->adDTO->setPoints(50);
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 50);
    }

    /**
     * Test if the Evaluator changes the points when out of range
     */
    public function testPointsIncorrect(): void
    {
        $this->adDTO->setPoints(101);
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 100);

        $this->adDTO->setPoints(-1);
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);

        $this->adDTO->setPoints(1000);
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 100);

        $this->adDTO->setPoints(-1000);
        $this->pointControllerQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);
    }
}

<?php

use Domain\DTO\AdDTO;
use Domain\Evaluation\Evaluators\DescriptionTextQE;
use PHPUnit\Framework\TestCase;


/**
 * TestCase DescriptionTextQETest
 * Evaluates The Class DescriptionTextQE
 */
class DescriptionTextQETest extends TestCase
{

    private $descriptionTextQE;
    private $adDTO, $adDTO1, $adDTO2;

    public function setUp(): void
    {
        $this->descriptionTextQE = new DescriptionTextQE();

        $this->adDTO = new AdDTO(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null, null);
        $this->adDTO1 = new AdDTO(1, 'CHALET', '', [], 300, null, null, null);
    }

    /**
     * Test an Ad with normal Description
     */
    public function testNormalDescription(): void
    {
        $this->descriptionTextQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 5);
    }

    /**
     * Test an Ad with empty Description
     */
    public function testEmptyDescription(): void
    {
        $this->descriptionTextQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 0);
    }
}

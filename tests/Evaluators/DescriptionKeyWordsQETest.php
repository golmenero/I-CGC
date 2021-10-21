<?php

use Domain\DTO\AdDTO;
use Domain\Evaluation\Evaluators\DescriptionKeyWordsQE;
use PHPUnit\Framework\TestCase;


/**
 * TestCase DescriptionKeyWordsQETest
 * Evaluates The Class DescriptionKeyWordsQE
 */
class DescriptionKeyWordsQETest extends TestCase
{

    private $descriptionKeyWordsQE;
    private $adDTO, $adDTO1, $adDTO2, $adDTO3;

    public function setUp(): void
    {
        $this->descriptionKeyWordsQE = new DescriptionKeyWordsQE();

        $this->adDTO = new AdDTO(1, 'CHALET', 'Este piso no tiene palabras clave', [], 300, null, null, null);
        $this->adDTO1 = new AdDTO(1, 'CHALET', 'Este piso solo tiene una palabra clave y es Luminoso', [], 300, null, null, null);
        $this->adDTO2 = new AdDTO(1, 'CHALET', 'Este piso solo tiene varias palabras clave y son Luminoso,Céntrico y ático', [], 300, null, null, null);
        $this->adDTO3 = new AdDTO(1, 'CHALET', 'Este piso solo tiene todas las palabras clave y son Luminoso, luminoso, Nuevo, nuevo, Céntrico,
            céntrico, Reformado, reformado, Ático y ático', [], 300, null, null, null);
    }

    /**
     * Test id an Ads description has no keywords 
     */
    public function testNoKeyWords(): void
    {
        $this->descriptionKeyWordsQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);
    }

    /**
     * Test id an Ads description has one keyword
     */
    public function testOneKeyWord(): void
    {
        $this->descriptionKeyWordsQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 5);
    }

    /**
     * Test id an Ads description has multiple keywords
     */
    public function testMultipleKeyWords(): void
    {
        $this->descriptionKeyWordsQE->evaluate($this->adDTO2);
        $this->assertEquals($this->adDTO2->getPoints(), 15);
    }

    /**
     * Test id an Ads description has all keywords
     */
    public function testAllKeyWords(): void
    {
        $this->descriptionKeyWordsQE->evaluate($this->adDTO3);
        $this->assertEquals($this->adDTO3->getPoints(), 50);
    }


}

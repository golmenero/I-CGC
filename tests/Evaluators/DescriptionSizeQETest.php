<?php

use Domain\DTO\AdDTO;
use Domain\Evaluation\Evaluators\DescriptionSizeQE;
use PHPUnit\Framework\TestCase;


/**
 * TestCase DescriptionSizeQETest
 * Evaluates The Class DescriptionSizeQE
 */
class DescriptionSizeQETest extends TestCase
{

    private $descriptionSizeQE;
    private $adDTO, $adDTO1, $adDTO2;

    public function setUp(): void
    {
        $this->descriptionSizeQE = new DescriptionSizeQE();

        $this->adDTO = new AdDTO(1, 'FLAT', 'Less than 20 P', [], 300, null, null, null);
        $this->adDTO1 = new AdDTO(1, 'FLAT', 'More than 20, less than 49. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
            ut labore et dolore magna aliqua.', [], 300, null, null, null);
        $this->adDTO2 = new AdDTO(1, 'FLAT', 'More than 50,. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
            sunt in culpa qui officia deserunt mollit anim id est laborum.', [], 300, null, null, null);
    }

    /**
     * Test an Ad if it has a description with less than 20 words, 
     * regardless of the Typoology
     */
    public function testL20CharDescription(): void
    {
        // FLAT
        $this->descriptionSizeQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);

        // CHALET
        $this->adDTO->setTypology('CHALET');
        $this->descriptionSizeQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);

        // GARAGE
        $this->adDTO->setTypology('GARAGE');
        $this->descriptionSizeQE->evaluate($this->adDTO);
        $this->assertEquals($this->adDTO->getPoints(), 0);
    }

    /**
     * Test an Ad if it has a description with more than 20 words and less then 49, 
     * regardless of the Typoology
     */
    public function testM20L49CharDescription(): void
    {
        // FLAT
        $this->descriptionSizeQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 10);
        $this->adDTO1->setPoints(0);

        // CHALET
        $this->adDTO1->setTypology('CHALET');
        $this->descriptionSizeQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 0);
        $this->adDTO1->setPoints(0);

        // GARAGE
        $this->adDTO1->setTypology('GARAGE');
        $this->descriptionSizeQE->evaluate($this->adDTO1);
        $this->assertEquals($this->adDTO1->getPoints(), 0);
    }

        /**
     * Test an Ad if it has a description with more than 50 words, 
     * regardless of the Typoology
     */
    public function testM50CharDescription(): void
    {
        // FLAT
        $this->descriptionSizeQE->evaluate($this->adDTO2);
        $this->assertEquals($this->adDTO2->getPoints(), 30);
        $this->adDTO2->setPoints(0);

        // CHALET
        $this->adDTO2->setTypology('CHALET');
        $this->descriptionSizeQE->evaluate($this->adDTO2);
        $this->assertEquals($this->adDTO2->getPoints(), 20);
        $this->adDTO2->setPoints(0);

        // GARAGE
        $this->adDTO2->setTypology('GARAGE');
        $this->descriptionSizeQE->evaluate($this->adDTO2);
        $this->assertEquals($this->adDTO2->getPoints(), 0);
    }

}

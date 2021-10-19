<?php
declare(strict_types=1);

namespace App\Domain\Evaluator;

use App\Domain\Evaluator\Evaluators\DescriptionTextQE;
use App\Domain\Evaluator\Evaluators\PictureQE;

class PointEvaluator
{
    private $evaluators;

    public function __construct()
    {
        $this->loadEvaluators();
    }

    public function loadEvaluators(){
        $this->evaluators = array(
            new PictureQE(),
            new DescriptionTextQE());
    }

    public function evaluate($ads){
        foreach($ads as $ad){ 
            foreach($this->evaluators as $evaluator){
                $evaluator->evaluate($ad);
            }
        }
        
        return $ads;
    }
}

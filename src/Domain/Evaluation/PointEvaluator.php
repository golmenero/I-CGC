<?php

declare(strict_types=1);

namespace Domain\Evaluator;

use Domain\Evaluation\Evaluators\PictureQE;
use Domain\Evaluation\Evaluators\CompleteAdQE;
use Domain\Evaluation\Evaluators\DescriptionKeyWordsQE;
use Domain\Evaluation\Evaluators\DescriptionSizeQE;
use Domain\Evaluation\Evaluators\DescriptionTextQE;
use Domain\Evaluation\Evaluators\PointControllerQE;

class PointEvaluator
{
    private $evaluators;

    public function __construct()
    {
        $this->loadEvaluators();
    }

    public function loadEvaluators()
    {
        $this->evaluators = array(
            new PictureQE(),
            new DescriptionTextQE(),
            new DescriptionSizeQE(),
            new DescriptionKeyWordsQE(),
            new CompleteAdQE(),
            new PointControllerQE()
        );
    }

    public function evaluate($ads)
    {
        foreach ($ads as $ad) {
            foreach ($this->evaluators as $evaluator) {
                $evaluator->evaluate($ad);
            }
        }

        return $ads;
    }
}

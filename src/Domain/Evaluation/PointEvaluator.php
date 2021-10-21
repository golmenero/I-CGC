<?php

declare(strict_types=1);

namespace Domain\Evaluator;

use Domain\Evaluation\Evaluators\PictureQE;
use Domain\Evaluation\Evaluators\CompleteAdQE;
use Domain\Evaluation\Evaluators\DescriptionKeyWordsQE;
use Domain\Evaluation\Evaluators\DescriptionSizeQE;
use Domain\Evaluation\Evaluators\DescriptionTextQE;
use Domain\Evaluation\Evaluators\PointControllerQE;

/**
 * Class PointEvaluator
 * This Class initiates all the evaluators that we want to apply to the different.
 */
class PointEvaluator
{
    private $evaluators;

    /**
     * The constructor for the class PointEvaluator
     */
    public function __construct()
    {
        $this->loadEvaluators();
    }

    /**
     * This function loads all the evaluators that we wantt to apply to the ads
     */
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

    /**
     * This function evaluates all the ads depending on the Evaluators loaded. Updates parameter 'points' of all ads.
     * @param mixed $ads Array[ads] The ads previous to evaluation
     * @return Array[AdDTO] The ads evaluates
     */
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

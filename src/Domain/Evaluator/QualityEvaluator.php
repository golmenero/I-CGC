<?php
declare(strict_types=1);

namespace App\Domain\Evaluator;

interface QualityEvaluator{
    public function evaluate($ad);
}
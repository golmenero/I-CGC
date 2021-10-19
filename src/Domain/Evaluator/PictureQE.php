<?php
declare(strict_types=1);

namespace App\Domain\Evaluator;

class PictureQE implements QualityEvaluator
{
    public function evaluate($ads)
    {
        $size = count($ads->pictures);
        $points = 0;

        if ($size <= 0) {
            $points = -10;
        } else {
            foreach ($ads->pictures as $picture) {
                if ($picture->quality == 'HD') {
                    $points += 20;
                } else if ($picture->quality == 'SD') {
                    $points += 10;
                }
            }
        }

        $ads->increasePoints($points);
    }
}

<?php

namespace App\Domain\Evaluator\Evaluators;

interface QualityEvaluator
{
    public function evaluate($ad);
}

class PictureQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        $size = count($ad->pictures);
        $points = 0;

        if ($size <= 0) {
            $points = -10;
        } else {
            foreach ($ad->pictures as $picture) {
                if ($picture->quality == 'HD') {
                    $points += 20;
                } else if ($picture->quality == 'SD') {
                    $points += 10;
                }
            }
        }

        $ad->increasePoints($points);
    }
}

class DescriptionTextQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        if (!empty($ad->description))
            $ad->increasePoints(5);
    }
}

class DescriptionSizeQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        $length = strlen($ad->description);
        $typology = $ad->typology;

        if ($typology == 'FLAT') {
            if ($length >= 20 && $length < 50)
                $ad->increasePoints(10);
            else if ($length >= 50)
                $ad->increasePoints(30);
        } else if ($typology == 'CHALET') {
            if ($length >= 50)
                $ad->increasePoints(20);
        }
    }
}



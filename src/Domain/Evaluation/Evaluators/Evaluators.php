<?php

namespace Domain\Evaluation\Evaluators;

interface QualityEvaluator
{
    public function evaluate($ad);
}

class PictureQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        $size = count($ad->getPictures());
        $points = 0;

        if ($size <= 0) {
            $points = -10;
        } else {
            foreach ($ad->getPictures() as $picture) {
                if ($picture->getQuality() == 'HD') {
                    $points += 20;
                } else if ($picture->getQuality() == 'SD') {
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
        if (!empty($ad->getDescription()))
            $ad->increasePoints(5);
    }
}

class DescriptionSizeQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        $length = strlen($ad->getDescription());
        $typology = $ad->getTypology();

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

class DescriptionKeyWordsQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        $description = $ad->getDescription();
        $keywords = array(
            "Luminoso", 'luminoso',
            'Nuevo', 'nuevo',
            'Céntrico', 'céntrico',
            'Reformado', 'reformado',
            'Ático', 'ático'
        );

        foreach ($keywords as $keyword) {
            if (strpos($description, $keyword)) {
                $ad->increasePoints(5);
            }
        }
    }
}

class CompleteAdQE implements QualityEvaluator
{
    public function evaluate($ad)
    {
        $complete = false;
        if (count($ad->getPictures()) > 0) {
            $typology = $ad->getTypology();
            if (!empty($ad->getDescription()) && $ad->getHouseSize() > 0) {
                if ($typology == 'CHALET') {
                    if ($ad->getGardenSize() > 0)
                        // CHALET has to have at least one picture, the size of it's description must be greater than 0 and houseSize and gardenSize must be greater than 0
                        $complete = true;
                } else if ($typology == "FLAT") {
                    // FLAT has to have at least one picture, the size of it's description must be greater than 0 and houseSize must be greater than 0
                    $complete = true;
                }
            }
            if ($typology == "GARAGE") {
                // GARAGE has to have at least one picture
                $complete = true;
            }
        }
        if ($complete)
            $ad->increasePoints(40);
    }
}

class PointControllerQE implements QualityEvaluator
{
    // We MUST control the Ad Points specifficaly at the end of the assignation
    public function evaluate($ad)
    {
        if ($ad->getPoints() > 100)
            $ad->setPoints(100);
        else if ($ad->getPoints() < 0)
            $ad->setPoints(0);
    }
}

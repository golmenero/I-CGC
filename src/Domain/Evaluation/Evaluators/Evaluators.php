<?php

namespace Domain\Evaluation\Evaluators;

/**
 * Interface QualityEvaluator
 * This interface declares all the commom methods for the different evaluators
 */
interface QualityEvaluator
{
    /**
     * This function evaluates an AdDTO
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
    public function evaluate($ad);
}

/**
 * Class PictureQE
 */
class PictureQE implements QualityEvaluator
{
    /**
     * Implementation of the method 'Evaluate'
     * * If the ad does not have any photos, 10 points are deducted. 
     * * Each photo in the ad provides 20 points if it is a high resolution (HD) photo or 10 if it is not. 
     * 
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
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

/**
 * Class DescriptionTextQE
 */
class DescriptionTextQE implements QualityEvaluator
{
    /**
     * Implementation of the method 'Evaluate'
     * * That the ad has a descriptive text adds 5 points.
     * 
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
    public function evaluate($ad)
    {
        if (!empty($ad->getDescription()))
            $ad->increasePoints(5);
    }
}

/**
 * Class DescriptionSizeQE
 */
class DescriptionSizeQE implements QualityEvaluator
{
    /**
     * Implementation of the method 'Evaluate'
     * * The size of the description also provides points when the ad is about a flat or a villa.
     * * In the case of flats, the description gives 10 points if it has between 20 and 49 words or 30 points if it has 50 or more words. 
     * * In the case of chalets, if it has more than 50 words, add 20 points.
     * 
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
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

/**
 * Class DescriptionKeyWordsQE
 */
class DescriptionKeyWordsQE implements QualityEvaluator
{
    /**
     * Implementation of the method 'Evaluate'
     * * That the following words appear in the description add 5 points each: Luminoso, Nuevo, Céntrico, Reformado, Ático.
     * 
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
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

/**
 * Class CompleteAdQE
 */
class CompleteAdQE implements QualityEvaluator
{
    /**
     * Implementation of the method 'Evaluate'
     * * That the ad is complete also scores points. 
     * * To consider a complete ad it must have a description, at least one photo and the particular data of each type, 
     * * that is, in the case of flats it must also have a dwelling size, in the case of chalets, dwelling size and of garden. 
     * * In addition, exceptionally, in garages it is not necessary for the advertisement to have a description. 
     * * If the ad has all of the above data, provide another 40 points.
     * 
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
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

/**
 * Class PointControllerQE
 */
class PointControllerQE implements QualityEvaluator
{
    /**
     * Implementation of the method 'Evaluate'
     * This method controlls when the Ad points are Greater than 100 or lower than 0. 
     * This Evaluator MUST be the last one. Otherwise, the Point evaluation would be unfair.
     * 
     * @param mixed $ad The AdDTO to evaluate
     * @return AdDTO the Ad updated
     */
    public function evaluate($ad)
    {
        if ($ad->getPoints() > 100)
            $ad->setPoints(100);
        else if ($ad->getPoints() < 0)
            $ad->setPoints(0);
    }
}

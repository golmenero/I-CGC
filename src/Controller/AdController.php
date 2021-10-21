<?php
namespace App\Controller;

use Domain\Evaluator\PointEvaluator;
use Domain\Manager\AdManager;
use Domain\Manager\PictureManager;
use InFileSystemPersistence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdController
 * This is the main and only controller. It displays all the information of the ads
 * and renders the view.
 */
class AdController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function example()
    {
        $pointEvaluator = new PointEvaluator();

        $fsp = new InFileSystemPersistence();
        $pictureManager = new PictureManager($fsp);
        $adManager = new AdManager($fsp);
        
        //$ads = $adManager->getAdsExtended($pictureManager);
        $ads = $pointEvaluator->evaluate($adManager->getAdsExtended($pictureManager));
        
        return $this->render('index.html.twig', ['ads' => $ads]);
    }

}

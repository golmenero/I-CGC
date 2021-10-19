<?php
namespace App\Controller;

use App\Domain\Evaluator\PointEvaluator;
use App\Domain\Manager\AdManager;
use App\Domain\Manager\PictureManager;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
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

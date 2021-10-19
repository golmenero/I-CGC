<?php
namespace App\Controller;

use App\Domain\Evaluator\PictureQE;
use App\Domain\Manager\AdManager;
use App\Domain\Manager\PictureManager;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{

    /**
     * @Route("/results/{ads}", name="results")
     */
    public function example($ads): Response
    {
        return $this->render('index.html.twig', ['ads' => $ads]);
    }

    /**
     * @Route("/", name="index")
     */
    public function prepareEvaluators()
    {
        $pictureQE = array(new PictureQE());

        $fsp = new InFileSystemPersistence();
        $pictureManager = new PictureManager($fsp);
        $adManager = new AdManager($fsp);

        $ads = $adManager->getAdsExtended($pictureManager);

        return $this->redirectToRoute('results', $ads);
    }
}

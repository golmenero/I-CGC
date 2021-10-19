<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Domain\AdManager;
use App\Domain\PictureManager;
use App\Infrastructure\Persistence\InFileSystemPersistence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function example(): Response
    {
        $fsp = new InFileSystemPersistence();
        $pictureManager = new PictureManager($fsp);
        $adManager = new AdManager($fsp);

        $ads = $adManager->getAdsExtended($pictureManager);

        return $this->render('index.html.twig', ['ads' => $ads]);
    }
}
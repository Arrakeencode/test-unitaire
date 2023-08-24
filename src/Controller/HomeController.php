<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $isConnected = $this->getUser() !== null;

        return $this->render('home/home.html.twig', [
            'isConnected' => $isConnected,
        ]);
    }
}

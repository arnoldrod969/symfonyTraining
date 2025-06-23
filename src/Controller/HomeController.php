<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home/{nom}', name: 'app_home')]
    public function index(string $nom = null): Response
    {

        $message = $nom ? "Bonjour, $nom !" : "Bonjour, don man !";

        $listType = [
            'nom' => 'don man',
            'age' => 20,
            'ville' => 'Paris',
        ];

        $listName = ['Alice', 'Bob', 'Charlie'];
        
        return $this->render('home/index.html.twig', [
            'listType' => $listType,
            'listName' => $listName,
            'message' => $message,
        ]);

        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
    }
}

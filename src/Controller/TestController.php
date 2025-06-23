<?php

namespace App\Controller ;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TestController extends AbstractController {

    public function index(string $nom = null) : Response {


        //return new Response('Hello World '. $nom);
        return $this->render('home.html.twig', [
            'nom' => $nom,
        ]);
    }

}
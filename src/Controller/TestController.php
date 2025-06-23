<?php

namespace App\Controller ;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TestController extends AbstractController {

    public function index() : Response {
        return new Response('Hello World');
    }

}
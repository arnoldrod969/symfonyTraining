<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Form\ArticleTypeForm;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(): Response
    {

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/article/new', name: 'article_new')]
    public function new(Request $request, EntityManagerInterface $em , ValidatorInterface $validator): Response
    {
        $article = new Article();
        $article->setDateCreation(new \DateTime());
       
        
        if ($request->isMethod('POST')) {
            $article->setTitle($request->request->get('title'));
            $article->setContent($request->request->get('content'));
            $article->setDateCreation($article->getDateCreation());
            
            $errors = $validator->validate($article);
        
            //dump($article);
            //exit();

            if (count($errors) === 0) {
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('articles_list');
            }
            
            // Afficher les erreurs dans le template
            foreach ($errors as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        }
        
        return $this->render('article/new.html.twig');
    }


    #[Route('/articles/list', name: 'articles_list')]
    public function list(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();
        
        return $this->render('article/list.html.twig', [
            'articles' => $articles
        ]);
    }

}
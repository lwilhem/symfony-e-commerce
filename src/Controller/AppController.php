<?php

namespace App\Controller;

use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(ProductCategoryRepository $productCategoryRepository ): Response
    {
        $categories = $productCategoryRepository->findAll();

        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
            'categories' => $categories
        ]);
    }
}

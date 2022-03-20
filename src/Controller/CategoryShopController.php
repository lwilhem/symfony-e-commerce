<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryShopController extends AbstractController
{
    #[Route('/category/{category_id}', name: 'app_category_list')]
    public function index(ProductRepository $productRepository, $category_id): Response
    {
        return $this->render('category_shop/index.html.twig', [
            'controller_name' => 'CategoryShopController',
            'products' => $productRepository->findByCategories($category_id),
        ]);
    }
}

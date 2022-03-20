<?php

namespace App\Controller;

use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryShopController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category_shop')]
    public function index(ProductRepository $productRepository, ProductCategoryRepository $categoryRepository, $id): Response
    {
        return $this->render('category_shop/index.html.twig', [
            'controller_name' => 'CategoryShopController',
            'products' => $productRepository->find($id),
        ]);
    }
}

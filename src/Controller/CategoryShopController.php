<?php

namespace App\Controller;

use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryShopController extends AbstractController
{
    #[Route('/category/{category_id}', name: 'app_category_list')]
    public function index(ProductRepository $productRepository, $category_id, ProductCategoryRepository $productCategoryRepository): Response
    {
        $page_id = $productCategoryRepository->findOneById($category_id);

        return $this->render('category_shop/index.html.twig', [
            'controller_name' => 'CategoryShopController',
            'products' => $productRepository->findByCategories($category_id),
            'shop_id' => $page_id->getId(),
        ]);
    }
}

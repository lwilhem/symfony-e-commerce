<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductListController extends AbstractController
{
    #[Route('/product', name: 'app_product_list')]
    public function index(ProductRepository $productRepository): Response
    {
        $list = $productRepository->findBy([],[],20);

        return $this->render('product_list/index.html.twig', [
            'controller_name' => 'ProductListController',
            'products' => $list,
        ]);
    }
}

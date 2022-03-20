<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductListController extends AbstractController
{
    #[Route('/product/list', name: 'app_product_list')]
    public function index(): Response
    {
        return $this->render('product_list/index.html.twig', [
            'controller_name' => 'ProductListController',
        ]);
    }
}

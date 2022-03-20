<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryShopController extends AbstractController
{
    #[Route('/category/shop', name: 'app_category_shop')]
    public function index(): Response
    {
        return $this->render('category_shop/index.html.twig', [
            'controller_name' => 'CategoryShopController',
        ]);
    }
}

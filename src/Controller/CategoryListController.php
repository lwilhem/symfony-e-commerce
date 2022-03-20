<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryListController extends AbstractController
{
    #[Route('/category/list', name: 'app_category_list')]
    public function index(): Response
    {
        return $this->render('category_list/index.html.twig', [
            'controller_name' => 'CategoryListController',
        ]);
    }
}

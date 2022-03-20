<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPageController extends AbstractController
{
    /**
     * @throws NonUniqueResultException
     */
    #[Route('/product/{id}', name: 'app_product_page')]
    public function index(ProductRepository $productRepository, $id): Response
    {
        $product = $productRepository->findOneById($id);

        return $this->render('product_page/index.html.twig', [
            'controller_name' => 'ProductPageController',
            'product' => $product,
            'picture' => 'public/uploads/products/' . $product->getPicture()
        ]);
    }
}

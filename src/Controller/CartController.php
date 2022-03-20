<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(ProductRepository $productRepository, SessionInterface $session, $id)
    {
        $cart = $session->get('cart', []);
        $product = $productRepository->findOneById($id);
        $product_id = $product->getId();

        if(!$cart[$product_id])
        {
            $cart[$product_id] ++;
        } else {
            $cart[$product_id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }
}

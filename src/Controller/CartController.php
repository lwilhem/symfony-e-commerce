<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart',[]);
        $cartData = [];
        $priceTotal = 0;

        foreach ($cart as $id => $itemQuantity)
        {
            $product = $productRepository->find($id);
            $cartData[] = [
                'product' => $product,
                'quantity' => $itemQuantity
            ];
            $priceTotal += $product->getPrice() * $itemQuantity;
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cartData' => $cartData,
            'total' => $priceTotal,
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(ProductRepository $productRepository, SessionInterface $session, $id)
    {
        $cart = $session->get('cart', []);
        $product = $productRepository->findOneById($id)->getId();

        if (!empty($cart[$product]))
        {
            $cart[$product]++;
        } else {
            $cart[$product] = 1;
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(ProductRepository $productRepository, SessionInterface $session, $id)
    {
        $cart = $session->get('cart', []);
        $product = $productRepository->findOneById($id)->getId();

        if (!empty($cart[$product]))
        {
           if($cart[$product] > 1) {
               $cart[$product]--;
           } else {
               unset($cart[$product]);
           }
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/delete/{id}', name: 'cart_delete')]
    public function delete(ProductRepository $productRepository, SessionInterface $session, $id)
    {
        $cart = $session->get('cart', []);
        $product = $productRepository->findOneById($id)->getId();

        if (!empty($cart[$product]))
        {
            unset($cart[$product]);
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }
    #[Route('/cart/delete/all', name: 'cart_delete_all')]
    public function deleteAllItem(SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        unset($cart);
        $session->set('cart', []);

        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/payments', name: 'cart_payments')]
    public function proceedToPayments(SessionInterface $session, ProductRepository $productRepository)
    {
        // TROUVER LES PRODUITS QUI SONT DANS LE PANIER AVEC LEURS ID DANS LA BDD
        // SOUSTRAIRE AU STOCK DE LA BDD LA QUANTITE ACHETE
        // DELETE LE CONTENU DU PANIER & REDIRECT VERS HOMES
        // IZI
        $cart = $session->get('cart', []);

    }
}

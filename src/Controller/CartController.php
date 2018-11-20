<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\AddItemType;
use App\Services\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart.index")
     *
     * @param CartManager $cartManager The service to manage cart.
     *
     * @return Response;
     */
    public function index(CartManager $cartManager)
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cartManager->getCart()
        ]);
    }

    /**
     * Display the form to add a product with its quantity.
     *
     * @param Product $product Product to add.
     *
     * @return Response
     */
    public function addItemForm(Product $product) : Response
    {
        $cartItem = new CartItem();
        $cartItem->setProductId($product->getId());

        $form = $this->createForm(AddItemType::class, $cartItem, [
            'action' => $this->generateUrl('cart_add_item'),
            'method' => 'POST'
        ]);

        return $this->render('cart/addItemForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cart/addItem", name="cart_add_item", methods={"POST"})
     *
     * @param Request $request
     * @param CartManager $cartManager The service to manage cart.
     *
     * @return Response;
     */
    public function addItem(Request $request, CartManager $cartManager) : Response
    {
        $cartItem = new CartItem();
        $form = $this->createForm(AddItemType::class, $cartItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartManager->addItemToCart($cartItem);
            $this->addFlash('success', 'Product add to cart');
        }

        return $this->redirectToRoute('cart.index');
    }
}

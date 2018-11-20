<?php

namespace App\Services;

use App\Entity\CartItem;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartManager
{
    const CART_SESSION_NAME = "mycart";

    /** @var SessionInterface $session */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getCart()
    {
        return $this->session->get(self::CART_SESSION_NAME, array());
    }

    public function setCart($newCart)
    {
        $this->session->set(self::CART_SESSION_NAME, $newCart);
    }

    public function addItemToCart(CartItem $cartItem)
    {
        $cart = $this->getCart();
        if (array_key_exists($cartItem->getProductId(), $cart)) {
            $cart[$cartItem->getProductId()] += $cartItem->getQuantity();
        } else {
            $cart[$cartItem->getProductId()] = $cartItem->getQuantity();
        }
        $this->setCart($cart);
    }
}
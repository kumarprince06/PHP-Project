<?php
class CartService
{
    protected $cartRepository;

    public function __construct()
    {
        $this->cartRepository = new CartRepository;
    }

    // Method to add product to cart
    public function addToCart(Cart $cart)
    {
        return $this->cartRepository->addToCart($cart);
    }

    // Method to increase product quantity in cart
    public function increaseQuantity(Cart $cart)
    {
        return $this->cartRepository->increaseQuantity($cart);
    }

    // Method to decrease product quantity in cart
    public function decreaseQuantity(Cart $cart)
    {
        return $this->cartRepository->decreaseQuantity($cart);
    }

    // Method to delete a cart item
    public function deleteCartItem(Cart $cart)
    {
        return $this->cartRepository->deleteCartItem($cart);
    }

    // 
    public function getCartItemsByUserId($userId)
    {
        return $this->cartRepository->getCartItemsByUserId($userId);
    }
}

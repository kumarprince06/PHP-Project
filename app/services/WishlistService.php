<?php

class WishlistService
{

    private $whishlistRepository;
    private $cartRepository;
    public function __construct()
    {
        $this->whishlistRepository = new WishlistRepositiory();
        $this->cartRepository = new CartRepository;
    }

    public function addWishlist(Wishlist $wishlist)
    {
        return $this->whishlistRepository->addWishlist($wishlist);
    }

    public function deleteWishlistItem(Wishlist $wishlist)
    {
        return $this->whishlistRepository->deleteWishlistItem($wishlist);
    }

    public function getWishlistByUserId(Wishlist $wishlist)
    {

        return $this->whishlistRepository->getWishlistByUserId($wishlist);
    }

    public function moveWishlistItemToCart(Cart $cart)
    {
        error_log("Goes to Cart Repository");
        // Add product to cart
        if ($this->cartRepository->addToCart($cart)) {
            // Delete from wishlist after successful addition to cart
            $wishlist = new Wishlist;
            $wishlist->setUserId($cart->getUserId());
            $wishlist->setProductId($cart->getProductId());
            return $this->whishlistRepository->deleteWishlistItem($wishlist);
        }

        return false;
    }
}

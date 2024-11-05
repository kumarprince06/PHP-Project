<?php
class OrderItem
{
    private $orderId;
    private $productId;
    private $categoryId;
    private $quantity;
    private $price;

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }
    public function getProductId()
    {
        return $this->productId;
    }
    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getPrice()
    {
        return $this->price;
    }
}

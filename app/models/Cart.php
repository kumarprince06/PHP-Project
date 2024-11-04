<?php

class Cart
{
    private $db;
    private $userId;
    private $productId;
    private $quantity;
    public function __construct()
    {
        $this->db = new Database;
    }

    // Getter / Setter
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}

<?php

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProducts()
    {
        $this->db->query('SELECT * FROM products');
        $productResult = $this->db->resultSet();
        return $productResult;
    }
}

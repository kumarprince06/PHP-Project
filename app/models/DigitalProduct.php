<?php

class DigitalProduct extends Product
{

    public function __construct()
    {
        parent::__construct();
    }

    // Add Product
    public function addDigitalProduct($data)
    {
        $this->setProductName($data['productName']);
        $this->setProductBrand($data['productBrand']);
        $this->setProductOriginalPrice($data['originalPrice']);
        $this->setProductSellingPrice($data['sellingPrice']);
        $this->setProductType($data['productType']);
        $this->setCategory($data['categoryId']);


        return $this->addProduct([
            'productName' => $this->getProductName(),
            'productBrand' => $this->getProductBrand(),
            'originalPrice' => $this->getProductOriginalPrice(),
            'sellingPrice' => $this->getProductSellingPrice(),
            'productType' => $this->getProductType(),
            'categoryId' => $this->getCategory(),
        ]);
    }


    // Update Product
    public function updateDigitalProduct($data)
    {
        $this->setProductName($data['productName']);
        $this->setProductBrand($data['productBrand']);
        $this->setProductOriginalPrice($data['originalPrice']);
        $this->setProductSellingPrice($data['sellingPrice']);
        $this->setProductType($data['productType']);
        $this->setId($data['id']);
        $this->setCategory($data['categoryId']);


        return $this->updateProduct([
            'productName' => $this->getProductName(),
            'productBrand' => $this->getProductBrand(),
            'originalPrice' => $this->getProductOriginalPrice(),
            'sellingPrice' => $this->getProductSellingPrice(),
            'productType' => $this->getProductType(),
            'id' => $this->getId(),
            'categoryId' => $this->getCategory(),
        ]);
    }
}

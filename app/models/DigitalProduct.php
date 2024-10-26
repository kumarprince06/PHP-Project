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


        return $this->addProduct([
            'productName' => $this->getProductName(),
            'productBrand' => $this->getProductBrand(),
            'originalPrice' => $this->getProductOriginalPrice(),
            'sellingPrice' => $this->getProductSellingPrice(),
            'productType' => $this->getProductType()
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


        return $this->updateProduct([
            'productName' => $this->getProductName(),
            'productBrand' => $this->getProductBrand(),
            'originalPrice' => $this->getProductOriginalPrice(),
            'sellingPrice' => $this->getProductSellingPrice(),
            'productType' => $this->getProductType(),
            'id' => $this->getId()
        ]);
    }
}

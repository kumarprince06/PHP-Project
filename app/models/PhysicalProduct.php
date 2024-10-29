<?php

class PhysicalProduct extends Product
{

    public function __construct()
    {
        parent::__construct();
    }

    // Add Product
    public function addPhysicalProduct($data)
    {
        $this->setProductName($data['productName']);
        $this->setProductBrand($data['productBrand']);
        $this->setProductOriginalPrice($data['originalPrice']);
        $this->setProductSellingPrice($data['sellingPrice']);
        $this->setProductType($data['productType']);
        $this->setCategory($data['categoryId']);


        $lastInsertedId =  $this->addProduct([
            'productName' => $this->getProductName(),
            'productBrand' => $this->getProductBrand(),
            'originalPrice' => $this->getProductOriginalPrice(),
            'sellingPrice' => $this->getProductSellingPrice(),
            'productType' => $this->getProductType(),
            'categoryId' => $this->getCategory(),
        ]);

        return $lastInsertedId;
    }

    // Update Product
    public function updatePhysicalProduct($data)
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

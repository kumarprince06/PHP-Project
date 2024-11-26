<?php

class Product
{
    protected $id;
    protected $name;
    protected $type;
    protected $brand;
    protected $sellingPrice;
    protected $originalPrice;
    protected $category;
    protected $stock;
    protected $image;
    private $description;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->brand = $data['brand'] ?? '';
        $this->sellingPrice = $data['sellingPrice'] ?? 0;
        $this->originalPrice = $data['originalPrice'] ?? 0;
        $this->category = $data['category'] ?? '';
        $this->stock = $data['stock'] ?? 0;
        $this->description = $data['description'] ?? '';
    }

    // Getters and Setters for ID
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getters and Setters for Name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getters and Setters for Type
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    // Getters and Setters for Brand
    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    // Getters and Setters for Selling Price
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
    }

    // Getters and Setters for Original Price
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    public function setOriginalPrice($originalPrice)
    {
        $this->originalPrice = $originalPrice;
    }

    // Getters and Setters for Category ID
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
    // Getter and Setter for stock

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getStock()
    {
        return $this->stock;
    }

    // Getter and setter for image
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

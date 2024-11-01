<?php

class Category
{
    private $id;
    private $categoryName;

    public function __construct($id = null, $categoryName = null)
    {
        $this->id = $id;
        $this->categoryName = $categoryName;
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }
}

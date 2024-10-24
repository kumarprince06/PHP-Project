<?php

class Products extends Controller
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }


    public function index()
    {
        $products = $this->productModel->getAllProducts();
        $data = [
            'title' => 'Shop',
            'products' => $products
        ];

        $this->view('products/index', $data);
    }
}

<?php

class Products extends Controller
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }


    // Index Page Handler
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        $data = [
            'title' => 'Shop',
            'products' => $products
        ];

        // Load Product Index Page
        $this->view('products/index', $data);
    }

    // Add Product Handler
    public function add()
    {
        // Check Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Process form
            // Initialize form data
            $data = [
                'title' => 'Shop',
                'productName' => trim($_POST['productName']),
                'productBrand' => trim($_POST['productBrand']),
                'originalPrice' => trim($_POST['originalPrice']),
                'sellingPrice' => trim($_POST['sellingPrice']),
                'productNameError' => '',
                'productBrandError' => '',
                'originalPriceError' => '',
                'sellingPriceError' => ''
            ];

            // Validate Product Name
            if (empty($data['productName'])) {
                $data['productNameError'] = "Product name is required!";
            }

            // Validate Product Brand
            if (empty($data['productBrand'])) {
                $data['productBrandError'] = "Brand name is required!";
            } else if (!preg_match("/^[a-zA-Z]+$/", $data['productBrand'])) {
                $data['productBrandError'] = "Only alphabets are allowed!";
            }

            // Validate Product Original Price
            if (empty($data['originalPrice'])) {
                $data['originalPriceError'] = 'Original price is required!';
            } else if (!preg_match("/^[0-9]+$/", $data['originalPrice'])) {
                $data['originalPriceError'] = 'Only numbers are allowed!';
            }

            // Validate Product Selling Price
            if (empty($data['sellingPrice'])) {
                $data['sellingPriceError'] = 'Selling price is required!';
            } else if (!preg_match("/^[0-9]+$/", $data['sellingPrice'])) {
                $data['sellingPriceError'] = 'Only numbers are allowed!';
            }

            // Check for No Error
            if (empty($data['productNameError']) && empty($data['productBrandError']) && empty($data['originalPriceError']) && empty($data['sellingPriceError'])) {
                // Validated 
                $lastInsertedId = $this->productModel->addProduct($data);
                if ($lastInsertedId) {
                    flashMessage(
                        'productMessage',
                        'Product added successfully'
                    );
                    // Redirect to the show page with the last inserted product ID
                    redirect('products/show/' . $lastInsertedId);
                } else {
                    die('Something went wrong..!');
                }
            } else {
                // Load View with errors
                $this->view('products/show', $data);
            }
        } else {
            // Initial empty form
            $data = [
                'title' => 'Shop',
                'productName' => '',
                'productBrand' => '',
                'originalPrice' => '',
                'sellingPrice' => '',
                'productNameError' => '',
                'productBrandError' => '',
                'originalPriceError' => '',
                'sellingPriceError' => ''
            ];

            $this->view('products/add', $data);
        }
    }

    // View Product Handler
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        $data = ['title' => 'Shop', 'product' => $product];
        $this->view('products/show', $data);
    }
}

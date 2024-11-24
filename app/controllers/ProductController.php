<?php

class ProductController extends Controller
{

    private $productService;
    private $categoryService;
    private $cartService;
    public function __construct()
    {
        // if (!isLoggedIn()) {

        //     redirect('pages/login');
        // }
        $this->productService = new ProductService();
        $this->categoryService = new CategoryService();
        $this->cartService = new CartService;
    }

    // Index Page Handler
    public function index()
    {
        $cartitems = [];

        // Check if the user is logged in
        if (isLoggedIn()) {
            // Fetch cart items for the logged-in user
            $cartitems = $this->cartService->getCartItemsByUserId($_SESSION['sessionData']['userId']);
            // die(var_dump($cartitems));
        }

        $products = $this->productService->getAllProducts();
        $data = [
            'title' => 'Shop',
            'products' => $products,
            'cartCount' => count($cartitems) // Use count() to get the number of items
        ];


        // Load Product Index Page
        $this->view('products/index', $data);
    }

    // Add Product Handler
    public function add()
    {

        $category = $this->categoryService->getAllCategories();

        $data = [
            'category' => $category,
        ];

        // Load View
        $this->view('products/add', $data);
    }


    // Create Product data
    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('productController');
            return;
        }

        // Initialize form data
        $data = $this->initializeProductData();

        // Validate data
        $this->validateProductData($data);

        // Upload Image
        uploadImage($data);

        // Check for no errors
        if ($this->hasNoErrors($data)) {
            // Validated
            // Add product
            $product = $data['type'] == 'Physical' ? new PhysicalProduct($data) : new DigitalProduct($data);
            $lastInsertedId = $this->productService->addProduct($product);

            if ($lastInsertedId) {
                flashMessage('successMessage', 'Product added successfully');
                // Redirect to the show page with the last inserted product ID
                redirect('adminController/inventory');
            } else {
                die('Something went wrong..!');
            }
        } else {
            // Load view with error
            $data['category'] = $this->categoryService->getAllCategories();
            $this->view('admin/addProduct', $data);
        }
    }

    // View Product Handler
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $data = ['title' => 'Shop', 'product' => $product];
        $this->view('products/show', $data);
    }

    // Edit / Update Product Handler
    public function edit($id)
    {

        // Fetch existing post
        $product = $this->productService->getProductById($id);
        $categoryList = $this->categoryService->getAllCategories();
        $data = [
            'title' => 'Shop',
            'id' => $product->id,
            'name' => $product->name,
            'brand' => $product->brand,
            'originalPrice' => $product->original_price,
            'sellingPrice' =>  $product->selling_price,
            'type' => $product->type,
            'category' => $product->category,
            'stock' => $product->stock,
            'nameError' => '',
            'brandError' => '',
            'originalPriceError' => '',
            'sellingPriceError' => '',
            'typeError' => '',
            'stockError' => '',
            'categoryList' => $categoryList
        ];

        $this->view('products/edit', $data);
    }

    // Update
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            flashErrorMessage('errorMessage', 'Something went error!');
            redirect('productController');
            return;
        }

        // Initialize form data
        $data = $this->initializeProductData();
        // die(var_dump($data));

        // Fetch the existing product to get the old image path
        $existingProduct = $this->productService->getProductById($data['id']);
        $oldImagePath = $existingProduct->image;

        // Validate data
        $this->validateProductData($data);

        // Check for no errors
        if ($this->hasNoErrors($data)) {
            // Validated
            // Upload Image
            uploadImage($data);
            // Add product
            $product = $data['type'] == 'Physical' ? new PhysicalProduct($data) : new DigitalProduct($data);
            if ($this->productService->updateProduct($product)) {
                // Delete Old Image
                deleteImageFromDirectory($oldImagePath);
                flashMessage('successMessage', 'Product updated successfully');
                // Redirect to the show page with the last inserted product ID
                redirect('adminController/inventory');
            } else {
                die('Something went wrong..!');
            }
        } else {
            // Load view with error
            $data['category'] = $this->categoryService->getAllCategories();
            $this->view('adminController/editController', $data);
        }
    }

    // Delete Product Handler
    public function delete($id)
    {
        // check for post request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('adminController/inventory');
            return;
        }

        $this->productService->deleteProduct($id);
        flashMessage('successMessage', 'Product deleted successfully');
        redirect('adminController/inventory');
    }

    // Initialize Form Data
    private function initializeProductData()
    {
        return [
            'id' => trim(($_POST['id'])) ?? '',
            'name' => trim($_POST['name']),
            'brand' => trim($_POST['brand']),
            'originalPrice' => trim($_POST['originalPrice']),
            'sellingPrice' => trim($_POST['sellingPrice']),
            'type' => trim($_POST['type']),
            'category' => trim($_POST['category']),
            'stock' => trim($_POST['stock']),
            'image' => '',
            'nameError' => '',
            'brandError' => '',
            'originalPriceError' => '',
            'sellingPriceError' => '',
            'typeError' => '',
            'categoryError' => '',
            'stockError' => '',
            'imageError' => ''
        ];
    }
    // Valiodate Data
    private function validateProductData(&$data)
    {
        if (empty($data['name'])) {
            $data['nameError'] = "Product name is required!";
        }
        if (empty($data['brand'])) {
            $data['brandError'] = "Brand name is required!";
        } elseif (!preg_match("/^[a-zA-Z]+$/", $data['brand'])) {
            $data['brandError'] = "Only alphabets are allowed!";
        }
        if (empty($data['originalPrice'])) {
            $data['originalPriceError'] = 'Original price is required!';
        } elseif (!preg_match("/^[0-9]+$/", $data['originalPrice'])) {
            $data['originalPriceError'] = 'Only numbers are allowed!';
        }
        if (empty($data['sellingPrice'])) {
            $data['sellingPriceError'] = 'Selling price is required!';
        } elseif (!preg_match("/^[0-9]+$/", $data['sellingPrice'])) {
            $data['sellingPriceError'] = 'Only numbers are allowed!';
        }
        if (empty($data['type'])) {
            $data['typeError'] = 'Select the product type!';
        }
        if (empty($data['category'])) {
            $data['categoryError'] = 'Select a category!';
        }

        if (empty($data['stock'])) {
            $data['stockError'] = 'Stock is required!';
        }
    }

    private function hasNoErrors($data)
    {
        return empty($data['productNameError']) && empty($data['productBrandError']) &&
            empty($data['originalPriceError']) && empty($data['sellingPriceError']) &&
            empty($data['productTypeError']) && empty($data['categoryIdError']) &&
            empty($data['stockError']);
    }
}

<?php

class ProductController extends Controller
{

    private $productService;
    private $categoryService;
    private $cartService;
    private $imageService;
    public function __construct()
    {
        // if (!isLoggedIn()) {

        //     redirect('pages/login');
        // }
        $this->productService = new ProductService();
        $this->categoryService = new CategoryService();
        $this->cartService = new CartService;
        $this->imageService = new ImageService;
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
        uploadImage($data, 'products');
        // Check for no errors
        if ($this->hasNoErrors($data)) {
            // Validated
            // Add product
            $product = $data['type'] == 'Physical' ? new PhysicalProduct($data) : new DigitalProduct($data);
            $lastInsertedId = $this->productService->addProduct($product);

            if ($lastInsertedId) {
                // Save images to the database
                $this->imageService->uploadImage($lastInsertedId, $data['images']);
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
        // Initialize cart items
        $cartitems = [];

        // Check if the user is logged in
        if (isLoggedIn()) {
            // Fetch cart items for the logged-in user
            $cartitems = $this->cartService->getCartItemsByUserId($_SESSION['sessionData']['userId']);
            // die(var_dump($cartitems));
        }

        $product = $this->productService->getProductById($id);
        $images = $this->imageService->getImagesByProductId($id);
        $data = [
            'title' => 'Shop',
            'product' => $product,
            'cartCount' => count($cartitems),
            'images' => $images
        ];
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

        // Check if a new image is uploaded
        if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
            // Upload new image
            uploadImage($data, 'products');

            // If upload fails, keep the old image
            if (!empty($data['imageError'])) {
                $data['image'] = $oldImagePath;
            }
        } else {
            // If no new image is uploaded, retain the old image
            $data['image'] = $oldImagePath;
        }

        // Check for no errors
        if ($this->hasNoErrors($data)) {

            // Add product
            $product = $data['type'] == 'Physical' ? new PhysicalProduct($data) : new DigitalProduct($data);
            if ($this->productService->updateProduct($product)) {
                // Delete Old Image
                deleteImageFromCloudinary($oldImagePath);
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
        // Log the incoming request
        error_log("Received delete request for product ID: " . $id);

        // Check for POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("Invalid request method for deleting product ID: " . $id);
            redirect('adminController/inventory');
            return;
        }

        // Get all images associated with the product
        $images = $this->imageService->getImagesByProductId($id);

        // Log the number of images associated with the product
        error_log("Found " . count($images) . " image(s) for product ID: " . $id);

        // Loop through the images and delete them
        foreach ($images as $image) {
            // Log image details before deletion
            error_log("Attempting to delete image: " . $image->name);

            // Delete the image from Cloudinary or the local server
            deleteImageFromCloudinary($image->name);

            // Log the deletion result of the image
            error_log("Successfully deleted image: " . $image->name);

            // Delete the image record from the database
            $imageDeletionResult = $this->imageService->deleteImage($id, $image->id);

            // Log the result of image deletion from the database
            if ($imageDeletionResult) {
                error_log("Successfully deleted image record for image ID: " . $image->id);
            } else {
                error_log("Failed to delete image record for image ID: " . $image->id);
            }
        }

        // Now delete the product from the database
        $productDeletionResult = $this->productService->deleteProduct($id);

        // Log the result of product deletion
        if ($productDeletionResult) {
            error_log("Successfully deleted product ID: " . $id);
        } else {
            error_log("Failed to delete product ID: " . $id);
        }

        // Set a success flash message
        flashMessage('successMessage', 'Product deleted successfully');

        // Redirect to the inventory page
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
            'description' => trim($_POST['description']),
            'images' => [],
            'nameError' => '',
            'brandError' => '',
            'originalPriceError' => '',
            'sellingPriceError' => '',
            'typeError' => '',
            'categoryError' => '',
            'stockError' => '',
            'descriptionError' => '',
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
        return empty($data['nameError']) && empty($data['brandError']) &&
            empty($data['originalPriceError']) && empty($data['sellingPriceError']) &&
            empty($data['typeError']) && empty($data['categoryError']) &&
            empty($data['stockError']) && empty($data['imageError']) && empty($data['descriptionError']);
    }

    public function deleteImage($id)
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            redirect('adminController/editProduct/' . $id);
        }

        // Get ImageURl and productId from POST
        $imageName = $_POST['image'];
        $productId = $_POST['productId'];

        error_log('Image Goes for deletion');

        // Delete the image from Cloudinary
        deleteImageFromCloudinary($imageName);
        // Now delete the image record from the database
        if ($this->imageService->deleteImage($productId, $id)) {
            // Redirect back to the product edit page after successful deletion
            redirect('adminController/editProduct/' . $productId);
        } else {
            // Handle the case where the image deletion from the database fails
            echo "Error: Unable to delete image from the database.";
        }

        redirect('adminController/editProduct/' . $productId);
    }
}

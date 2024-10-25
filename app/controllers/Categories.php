<?php

class Categories extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
    }

    // Category Index Handler
    public function index()
    {
        $categories = $this->categoryModel->getAllCategory();

        $data = ['title' => 'Shop', 'category' => $categories];
        $this->view('categories/index', $data);
    }

    // Category Add Handler
    public function add()
    {
        // Check for Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form
            // Initialize form data
            $data = [
                'title' => 'Shop',
                'categoryName' => $_POST['categoryName'],
                'categoryNameError' => ''
            ];

            // Validate Category Name
            if (empty($data['categoryName'])) {
                $data['categoryNameError'] = 'Category name is required!';
            }

            // Check for error
            if (empty($data['categoryNameError'])) {
                // Validated
                $lastInsertedId = $this->categoryModel->addCategory($data);
                if ($lastInsertedId) {
                    flashMessage(
                        'categoryMessage',
                        'Category added successfully'
                    );
                    // Redirect to the show page with the last inserted product ID
                    redirect('categories/show/' . $lastInsertedId);
                } else {
                    die('Something went wrong..!');
                }
            } else {
                // Load view with error
                $this->view('categories/add', $data);
            }
        } else {
            $data = [
                'title' => 'Shop',
                'categoryName' => '',
                'categoryNameError' => ''
            ];
            // Load the view
            $this->view('categories/add', $data);
        }
    }

    // Category Edit Handler
    public function edit($id)
    {
        // Check for Post Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form
            // Initialize form data
            $data = [
                'title' => 'Shop',
                'id' => $id,
                'categoryName' => $_POST['categoryName'],
                'categoryNameError' => ''
            ];

            // Validate Category Name
            if (empty($data['categoryName'])) {
                $data['categoryNameError'] = 'Category name is required!';
            }

            // Check for error
            if (empty($data['categoryNameError'])) {
                // Validated
                $lastInsertedId = $this->categoryModel->updateCategory($data);
                if ($lastInsertedId) {
                    flashMessage(
                        'categoryMessage',
                        'Category updated successfully'
                    );
                    // Redirect to the show page with the last inserted product ID
                    redirect('categories');
                } else {
                    die('Something went wrong..!');
                }
            } else {
                // Load view with error
                $this->view('categories/edit', $data);
            }
        } else {
            // Fetch Category data by ID
            $category = $this->categoryModel->getCategoryById($id);
            $data = [
                'title' => 'Shop',
                'id' => $id,
                'categoryName' => $category->categoryName,
                'categoryNameError' => ''
            ];
            // Load the view
            $this->view('categories/edit', $data);
        }
    }

    // Category Show Handler
    public function show($id)
    {

        $category = $this->categoryModel->getCategoryById($id);

        $data = ['title' => 'Shop', 'category' => $category];
        $this->view('categories/show', $data);
    }

    // Category Delete Handler

    // Delete Product Handler
    public function delete($id)
    {
        // check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proccess
            // Fetch existing post
            // $post = $this->productModel->getPostById($id);
            // // Check for owner
            // if ($post->userId != $_SESSION['user_id']) {
            //     redirect('posts');
            // }

            if ($this->categoryModel->deleteCategoryById($id)) {
                flashMessage('categoryMessage', 'Category deleted successfully');
                redirect('categories');
            }
        } else {
            // Redirect to post
            redirect('categories');
        }
    }
}

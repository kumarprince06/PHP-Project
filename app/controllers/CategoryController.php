<?php

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('pages/login');
        }
        $this->categoryService = new CategoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        $data = ['title' => 'Shop', 'category' => $categories];
        $this->view('categories/index', $data);
    }

    public function add()
    {
        $this->view('categories/add');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $data = ['title' => 'Shop', 'name' => '', 'nameError' => ''];
            $this->view('categories/add', $data);
        }

        $category = new category;
        $category->setName(trim($_POST['name']));
        try {
            $lastInsertedId = $this->categoryService->addCategory($category);
            error_log("Last Inserted ID: " . $lastInsertedId);
            flashMessage('successMessage', 'Category added successfully');
            redirect('categoryController/show/' . $lastInsertedId);
        } catch (Exception $e) {
            $data = [
                'title' => 'Shop',
                'name' => $category->getName(),
                'nameError' => $e->getMessage()
            ];
            $this->view('categories/add', $data);
        }
    }

    public function edit($id)
    {
        // Fetch category data by id
        $category = $this->categoryService->getCategoryById($id);
        // Prepare data for the view
        $data = [
            'title' => 'Edit Category',
            'id' => $id,
            'name' => $category->name,
            'nameError' => ''
        ];

        // Load the edit view with fetched data
        $this->view('categories/edit', $data);
    }


    // update
    public function update()
    {
        // 
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $data = ['title' => 'Shop', 'id' => '', 'name' => '', 'nameError' => ''];
            $this->view('categories/edit', $data);
        }

        $category = new category;
        $category->setName(trim($_POST['name']));
        $category->setId($_POST['id']);
        try {
            $lastInsertedId = $this->categoryService->updateCategory($category);
            error_log("Last Inserted ID: " . $lastInsertedId);
            flashMessage('successMessage', 'Category updated successfully');
            redirect('categoryController');
        } catch (Exception $e) {
            $data = [
                'title' => 'Shop',
                'name' => $category->getName(),
                'nameError' => $e->getMessage()
            ];
            $this->view('categories/add', $data);
        }
    }

    // Show
    public function show($id)
    {
        $categoryDetail = $this->categoryService->getCategoryById($id);

        $data = [
            'category' => $categoryDetail,
        ];

        $this->view('categories/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view('categories');
        }

        try {
            $this->categoryService->deleteCategoryById($id);
            flashMessage('successMessage', 'Category deleted successfully');
        } catch (Exception $e) {
            flashMessage('categoryMessage', 'Error: ' . $e->getMessage(), 'alert alert-danger');
        }
        redirect('categoryController');
    }
}

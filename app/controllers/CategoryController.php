<?php

class CategoryController extends Controller
{
    private $categoryService;
    private $category;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('pages/login');
        }
        $this->categoryService = new CategoryService;
        $this->category = new Category;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        $data = ['title' => 'Shop', 'category' => $categories];
        $this->view('categories/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $data = ['title' => 'Shop', 'categoryName' => '', 'categoryNameError' => ''];
            $this->view('categories/add', $data);
        }
        $category->setCategoryName(trim($_POST['categoryName']));
        try {
            $lastInsertedId = $this->categoryService->addCategory($category);
            flashMessage('successMessage', 'Category added successfully');
            redirect('categories/show/' . $lastInsertedId);
        } catch (Exception $e) {
            $data = [
                'title' => 'Shop',
                'categoryName' => $name,
                'categoryNameError' => $e->getMessage()
            ];
            $this->view('categories/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category = $this->categoryService->getCategoryById($id);
            $data = ['title' => 'Shop', 'id' => $id, 'categoryName' => $category->getCategoryName(), 'categoryNameError' => ''];
            $this->view('categories/edit', $data);
        }
        $categoryName = trim($_POST['categoryName']);
        try {
            $this->categoryService->updateCategory($id, $categoryName);
            flashMessage('categoryMessage', 'Category updated successfully');
            redirect('categories');
        } catch (Exception $e) {
            $data = ['title' => 'Shop', 'id' => $id, 'categoryName' => $categoryName, 'categoryNameError' => $e->getMessage()];
            $this->view('categories/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $this->categoryService->deleteCategoryById($id);
                flashMessage('categoryMessage', 'Category deleted successfully');
            } catch (Exception $e) {
                flashMessage('categoryMessage', 'Error: ' . $e->getMessage(), 'alert alert-danger');
            }
            redirect('categories');
        }
    }
}

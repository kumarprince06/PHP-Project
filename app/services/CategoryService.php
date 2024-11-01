<?php

class CategoryService extends Controller
{
    private $categoryRepository;
    private $categoryModel;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository;
        $this->categoryModel = $this->model('Category');
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategoryById($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('Invalid Category ID');
        }

        return $this->categoryRepository->getCategoryById($id);
    }

    public function addCategory(Category $category)
    {
        if (empty()) {
            throw new InvalidArgumentException('Category name is required');
        }

        $category = new Category(null, $categoryName);
        return $this->categoryRepository->addCategory($category);
    }

    public function updateCategory($id, $categoryName)
    {
        if (!is_numeric($id) || empty($categoryName)) {
            throw new InvalidArgumentException('Invalid data for updating category');
        }

        $category = new Category($id, $categoryName);
        return $this->categoryRepository->updateCategory($category);
    }

    public function deleteCategoryById($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('Invalid Category ID');
        }

        return $this->categoryRepository->deleteCategoryById($id);
    }
}

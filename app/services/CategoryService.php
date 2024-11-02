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
        if (empty($category->getName())) {
            throw new InvalidArgumentException('Category name is required!');
        }
        return $this->categoryRepository->addCategory($category);
    }

    public function updateCategory(Category $category)
    {
        
        // Validate Name
        if(empty($category->getName())){
            throw new InvalidArgumentException('Category name is required!');
        }
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

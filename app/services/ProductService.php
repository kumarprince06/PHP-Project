<?php
class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function addProduct($data)
    {
        // Validate data (you can extend this further)
        if (empty($data['name'])) {
            throw new Exception('Product name is required');
        }
        if (empty($data['price'])) {
            throw new Exception('Product price is required');
        }

        return $this->productRepository->addProduct($data);
    }

    public function updateProduct($id, $data)
    {
        // Validate data
        if (empty($data['name'])) {
            throw new Exception('Product name is required');
        }
        if (empty($data['price'])) {
            throw new Exception('Product price is required');
        }

        return $this->productRepository->updateProduct($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }
}

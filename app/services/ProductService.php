<?php
class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function addProduct(Product $product)
    {

        return $this->productRepository->addProduct($product);
    }

    public function updateProduct(Product $product)
    {

        return $this->productRepository->updateProduct($product);
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

    public function updateStock($productId, $quantity)
    {
        return $this->productRepository->updateStock($productId, $quantity);
    }

    public function getTotalProductCount()
    {
        return $this->productRepository->getTotalProductCount();
    }

    public function getTopSellingProduct()
    {
        return $this->productRepository->getTopSellingProduct();
    }

    public function getLowAndOutOfStockCounts()
    {
        return $this->productRepository->getLowAndOutOfStockCounts();
    }
}

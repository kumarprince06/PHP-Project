<?php
class ProductRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Assuming you have a Database class for DB connections
    }

    public function addProduct($data)
    {
        $sql = "INSERT INTO products (name, description, price, stock) VALUES (:name, :description, :price, :stock)";
        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);

        return $this->db->execute();
    }

    public function updateProduct($id, $data)
    {
        $sql = "UPDATE products SET name = :name, description = :description, price = :price, stock = :stock WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);

        return $this->db->execute();
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function getAllProducts()
    {
        $this->db->query("SELECT * FROM products");
        return $this->db->resultSet();
    }

    public function getProductById($id)
    {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->singleResult();
    }
}

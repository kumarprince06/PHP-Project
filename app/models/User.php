<?php

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // Get User By Email
    public function getUserByEmail($email)
    {
        try {
            $this->db->query('SELECT * FROM users WHERE email=:email');
            $this->db->bind(':email', $email);
            $row = $this->db->singleResult();
            return $this->db->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            die('Something went wrong ..!' . $e->getMessage());
        }
    }

    // User Register
    public function register($data)
    {
        try {
            $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            // Execute
            return $this->db->execute() ? true : false;
        } catch (PDOException $e) {
            die('Something went wrong ..!' . $e->getMessage());
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);

        $row = $this->db->singleResult();

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}

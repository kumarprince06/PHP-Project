<?php
class UserRepository
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
    public function register(User $user)
    {
        try {
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $this->db->bind(':name', $user->getName());
            $this->db->bind(':email', $user->getEmail());
            $this->db->bind(':password', $user->getPassword());
            // Execute
            return $this->db->execute() ? true : false;
        } catch (PDOException $e) {
            die('Something went wrong ..!' . $e->getMessage());
        }
    }

    // Login User
    public function login(User $user)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $user->getEmail());

        $row = $this->db->singleResult();

        $hashedPassword = $row->password;
        if (password_verify($user->getPassword(), $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}

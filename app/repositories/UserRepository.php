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
            return $this->db->singleResult();
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

    public function getTotalUserCount()
    {
        // Query to count the total number of users
        $this->db->query('SELECT COUNT(*) AS total FROM users');

        // Fetch the result, assuming single() fetches the first row of the result set
        $userCount = $this->db->singleResult();  // This should return the first result (total)

        // If the result is an object, access the 'total' property
        if (is_object($userCount)) {
            $userCount = $userCount->total;
        }
        return $userCount;
    }

    public function updatePassword($newPassword, $email)
    {

        // Prepare the query to update the password
        $this->db->query("UPDATE users SET password=:password WHERE email=:email");

        // Bind the parameters
        $this->db->bind(':password', $newPassword);
        $this->db->bind(':email', $email);

        // Execute the query and return the result
        return $this->db->execute();
    }
}

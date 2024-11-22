<?php
class UserService
{
    private $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }


    // Get User By Email
    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    // User Register
    public function register(User $user)
    {
        return $this->userRepository->register($user);
    }

    // Login User
    public function login(User $user)
    {
        return $this->userRepository->login($user);
    }

    public function getTotalUserCount(){
        return $this->userRepository->getTotalUserCount();
    }
}

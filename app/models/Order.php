<?php
class Order
{
    private $userId;
    private $total;

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function getTotal()
    {
        return $this->total;
    }
}
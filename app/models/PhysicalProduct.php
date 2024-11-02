<?php

class PhysicalProduct extends Product
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->setType('Physical'); // Set type to Physical
    }
}

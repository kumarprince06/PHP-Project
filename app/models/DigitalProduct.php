<?php

class DigitalProduct extends Product
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->setType('Digital'); // Set type to Digital
    }
}

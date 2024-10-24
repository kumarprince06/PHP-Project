<?php

class Pages extends Controller
{


    public function __construct() {}

    public function index()
    {
        $data = [
            'title' => 'Shop',

        ];

        $this->view('pages/index', $data);
    }
}

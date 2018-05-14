<?php

namespace App\Controller;


class ApplyController extends AppController
{

    public function index()
    {
        if ($this->request->is('post')) {
            $name = $this->request->getData('name');
        }
    }
}
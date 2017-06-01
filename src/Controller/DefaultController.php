<?php
namespace App\Controller;

use App\Controller\AppController;

class DefaultController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }
    public function index()
    {
       $this->viewBuilder()->layout('home');
    }
}

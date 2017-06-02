<?php
namespace AgiraForum\Controller;

use AgiraForum\Controller\AppController;

class DefaultController extends AppController
{
    public function index()
    {
       $this->viewBuilder()->layout('home');
    }
}

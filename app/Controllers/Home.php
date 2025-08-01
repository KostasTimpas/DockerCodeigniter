<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();

        $data = [
            'title' => 'Home',
            'articles' => $articleModel->findAll(6),
            'categories' => $categoryModel->findAll()
        ];

        return view('templates/header', $data)
            . view('home')
            . view('templates/footer');
    }
}
<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $data = [
            'title' => 'Articles',
            'articles' => $articleModel->findAll()
        ];
        
        return view('templates/header', $data)
            . view('articles/index')
            . view('templates/footer');
    }
    
    public function view($id = null)
    {
        $articleModel = new ArticleModel();
        
        $article = $articleModel->find($id);
        
        if (empty($article)) {
            throw new PageNotFoundException('Cannot find the article with ID: ' . $id);
        }
        
        // Get the categories for this article
        $article['categories'] = $articleModel->getCategories($id);
        
        $data = [
            'title' => $article['title'],
            'article' => $article
        ];
        
        return view('templates/header', $data)
            . view('articles/view')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $categoryModel = new CategoryModel();

        $data = [
            'title' => 'Create a New Article',
            'categories' => $categoryModel->findAll()
        ];

        return view('templates/header', $data)
            . view('articles/create')
            . view('templates/footer');
    }

    public function store()
    {
        helper('form');

        $categoryModel = new CategoryModel();
        $articleModel = new ArticleModel();

        $data = [
            'title' => 'Create a New Article',
            'categories' => $categoryModel->findAll()
        ];

        // Handle file upload
        $featuredImage = $this->request->getFile('featured_image');
        $imagePath = null;

        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            $newName = $featuredImage->getRandomName();
            $featuredImage->move(ROOTPATH . 'public/uploads', $newName);
            $imagePath = 'uploads/' . $newName;
        }

        $articleData = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content')
        ];

        if ($imagePath) {
            $articleData['featured_image'] = $imagePath;
        }

        if ($articleModel->save($articleData)) {
            $articleId = $articleModel->getInsertID();

            // Save categories
            $categoryIds = $this->request->getPost('categories') ?? [];
            $articleModel->addCategories($articleId, $categoryIds);

            return redirect()->to("/articles/{$articleId}")
                ->with('message', 'Article created successfully');
        }

        $data['validation'] = $articleModel->errors();

        return view('templates/header', $data)
            . view('articles/create')
            . view('templates/footer');
    }

    public function edit($id = null)
    {
        helper('form');

        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();

        $article = $articleModel->find($id);

        if (empty($article)) {
            throw new PageNotFoundException('Cannot find the article with ID: ' . $id);
        }

        $articleCategories = $articleModel->getCategories($id);
        $selectedCategories = array_column($articleCategories, 'id');

        $data = [
            'title' => 'Edit Article',
            'article' => $article,
            'categories' => $categoryModel->findAll(),
            'selectedCategories' => $selectedCategories
        ];

        return view('templates/header', $data)
            . view('articles/edit')
            . view('templates/footer');
    }

    public function update($id = null)
    {
        helper('form');

        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();

        $article = $articleModel->find($id);

        if (empty($article)) {
            throw new PageNotFoundException('Cannot find the article with ID: ' . $id);
        }

        $articleData = [
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content')
        ];

        // Handle file upload
        $featuredImage = $this->request->getFile('featured_image');

        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            if (!empty($article['featured_image']) && file_exists(ROOTPATH . 'public/' . $article['featured_image'])) {
                unlink(ROOTPATH . 'public/' . $article['featured_image']);
            }

            $newName = $featuredImage->getRandomName();
            $featuredImage->move(ROOTPATH . 'public/uploads', $newName);
            $articleData['featured_image'] = 'uploads/' . $newName;
        }

        if ($articleModel->save($articleData)) {
            $categoryIds = $this->request->getPost('categories') ?? [];
            $articleModel->addCategories($id, $categoryIds);

            return redirect()->to("/articles/{$id}")
                ->with('message', 'Article updated successfully');
        }

        // If validation fails, reload the form with errors
        $articleCategories = $articleModel->getCategories($id);
        $selectedCategories = array_column($articleCategories, 'id');

        $data = [
            'title' => 'Edit Article',
            'article' => $article,
            'categories' => $categoryModel->findAll(),
            'selectedCategories' => $selectedCategories,
            'validation' => $articleModel->errors()
        ];

        return view('templates/header', $data)
            . view('articles/edit')
            . view('templates/footer');
    }
    
    public function delete($id = null)
    {
        $articleModel = new ArticleModel();
        
        $article = $articleModel->find($id);
        
        if (empty($article)) {
            throw new PageNotFoundException('Cannot find the article with ID: ' . $id);
        }
        
        // Delete the featured image if exists
        if (!empty($article['featured_image']) && file_exists(ROOTPATH . 'public/' . $article['featured_image'])) {
            unlink(ROOTPATH . 'public/' . $article['featured_image']);
        }
        
        $articleModel->delete($id);
        
        return redirect()->to('/articles')
            ->with('message', 'Article deleted successfully');
    }
}

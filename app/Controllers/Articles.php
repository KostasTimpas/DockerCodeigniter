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
        
        if ($this->request->getMethod() === 'post') {
            $articleModel = new ArticleModel();
            
            // Handle file upload if exists
            $featuredImage = $this->request->getFile('featured_image');
            $imagePath = null;
            
            if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
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
                
                // Save the categories
                $categoryIds = $this->request->getPost('categories') ?? [];
                $articleModel->addCategories($articleId, $categoryIds);
                
                return redirect()->to("/articles/{$articleId}")
                    ->with('message', 'Article created successfully');
            }
            
            $data['validation'] = $articleModel->errors();
        }
        
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
        
        // Get categories for this article
        $articleCategories = $articleModel->getCategories($id);
        $selectedCategories = array_column($articleCategories, 'id');
        
        $data = [
            'title' => 'Edit Article',
            'article' => $article,
            'categories' => $categoryModel->findAll(),
            'selectedCategories' => $selectedCategories
        ];
        
        if ($this->request->getMethod() === 'post') {
            // Handle file upload if exists
            $featuredImage = $this->request->getFile('featured_image');
            
            $articleData = [
                'id' => $id,
                'title' => $this->request->getPost('title'),
                'content' => $this->request->getPost('content')
            ];
            
            if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                // Delete old image if exists
                if (!empty($article['featured_image']) && file_exists(ROOTPATH . 'public/' . $article['featured_image'])) {
                    unlink(ROOTPATH . 'public/' . $article['featured_image']);
                }
                
                $newName = $featuredImage->getRandomName();
                $featuredImage->move(ROOTPATH . 'public/uploads', $newName);
                $articleData['featured_image'] = 'uploads/' . $newName;
            }
            
            if ($articleModel->save($articleData)) {
                // Save the categories
                $categoryIds = $this->request->getPost('categories') ?? [];
                $articleModel->addCategories($id, $categoryIds);
                
                return redirect()->to("/articles/{$id}")
                    ->with('message', 'Article updated successfully');
            }
            
            $data['validation'] = $articleModel->errors();
        }
        
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

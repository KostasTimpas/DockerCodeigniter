<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Categories extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Categories',
            'categories' => $categoryModel->findAll()
        ];
        
        return view('templates/header', $data)
            . view('categories/index')
            . view('templates/footer');
    }
    
    public function view($id = null)
    {
        $categoryModel = new CategoryModel();
        
        $category = $categoryModel->find($id);
        
        if (empty($category)) {
            throw new PageNotFoundException('Cannot find the category with ID: ' . $id);
        }
        
        // Get the articles for this category
        $articles = $categoryModel->getArticles($id);
        
        $data = [
            'title' => $category['name'],
            'category' => $category,
            'articles' => $articles
        ];
        
        return view('templates/header', $data)
            . view('categories/view')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = [
            'title' => 'Create a New Category'
        ];

        return view('templates/header', $data)
            . view('categories/create')
            . view('templates/footer');
    }

    public function store()
    {
        helper(['form', 'url']);

        $categoryModel = new CategoryModel();

        $categoryData = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($categoryModel->save($categoryData)) {
            $categoryId = $categoryModel->getInsertID();

            return redirect()->to("/categories/{$categoryId}")
                ->with('message', 'Category created successfully');
        }

        $data = [
            'title' => 'Create a New Category',
            'validation' => $categoryModel->errors()
        ];

        return view('templates/header', $data)
            . view('categories/create')
            . view('templates/footer');
    }

    public function edit($id = null)
    {
        helper('form');

        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if (empty($category)) {
            throw new PageNotFoundException('Cannot find the category with ID: ' . $id);
        }

        $data = [
            'title' => 'Edit Category',
            'category' => $category
        ];

        return view('templates/header', $data)
            . view('categories/edit')
            . view('templates/footer');
    }

    public function update($id = null)
    {
        helper('form');

        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if (empty($category)) {
            throw new PageNotFoundException('Cannot find the category with ID: ' . $id);
        }

        $categoryData = [
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($categoryModel->save($categoryData)) {
            return redirect()->to("/categories/{$id}")
                ->with('message', 'Category updated successfully');
        }

        $data = [
            'title' => 'Edit Category',
            'category' => $category,
            'validation' => $categoryModel->errors()
        ];

        return view('templates/header', $data)
            . view('categories/edit')
            . view('templates/footer');
    }
    
    public function delete($id = null)
    {
        $categoryModel = new CategoryModel();
        
        $category = $categoryModel->find($id);
        
        if (empty($category)) {
            throw new PageNotFoundException('Cannot find the category with ID: ' . $id);
        }
        
        $categoryModel->delete($id);
        
        return redirect()->to('/categories')
            ->with('message', 'Category deleted successfully');
    }
}

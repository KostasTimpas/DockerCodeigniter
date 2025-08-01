<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';
    
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['name', 'description'];
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
    ];
    
    /**
     * Get articles for a specific category
     *
     * @param int $categoryId
     * @return array
     */
    public function getArticles(int $categoryId)
    {
        $builder = $this->db->table('article_category');
        $builder->select('articles.*');
        $builder->join('articles', 'articles.id = article_category.article_id');
        $builder->where('article_category.category_id', $categoryId);
        
        return $builder->get()->getResultArray();
    }
}

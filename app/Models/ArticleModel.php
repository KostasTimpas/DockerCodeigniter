<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table      = 'articles';
    protected $primaryKey = 'id';
    
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['title', 'content', 'featured_image'];
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'content' => 'required',
    ];
    
    /**
     * Get categories for a specific article
     *
     * @param int $articleId
     * @return array
     */
    public function getCategories(int $articleId)
    {
        $builder = $this->db->table('article_category');
        $builder->select('categories.*');
        $builder->join('categories', 'categories.id = article_category.category_id');
        $builder->where('article_category.article_id', $articleId);
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Add categories to an article
     *
     * @param int $articleId
     * @param array $categoryIds
     * @return bool
     */
    public function addCategories(int $articleId, array $categoryIds)
    {
        // First remove all existing categories
        $this->db->table('article_category')->where('article_id', $articleId)->delete();
        
        // Add the new categories
        $data = [];
        foreach ($categoryIds as $categoryId) {
            $data[] = [
                'article_id' => $articleId,
                'category_id' => $categoryId
            ];
        }
        
        if (!empty($data)) {
            return $this->db->table('article_category')->insertBatch($data);
        }
        
        return true;
    }
}

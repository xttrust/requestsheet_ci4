<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'url', 'title', 'seo_title', 'seo_description',
        'content', 'date_created', 'author', 'picture'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Count the number of rows where a specific column matches a given value
    public function countWhere($column, $value) {
        return $this->where($column, $value)->countAllResults();
    }

    // Get the latest news articles
    public function getByLatest($limit = 10) {
        return $this->orderBy('date_created', 'DESC')->findAll($limit);
    }

    // Get a news article by its ID
    public function getById($id) {
        return $this->find($id);
    }

    // Get a single news article by a specific column and value
    public function getBy($column, $value) {
        return $this->where($column, $value)->first();
    }

    // Get all news articles by a specific author
    public function getByAuthor($author, $limit = 10) {
        return $this->where('author', $author)->orderBy('date_created', 'DESC')->findAll($limit);
    }

    // Get all news articles by a specific category (if category field exists)
    public function getByCategory($category, $limit = 10) {
        return $this->where('category', $category)->orderBy('date_created', 'DESC')->findAll($limit);
    }

    // Get paginated results
    public function getPaginated($limit, $offset) {
        return $this->orderBy('date_created', 'DESC')->findAll($limit, $offset);
    }

    // Search news articles by title or content
    public function search($query, $limit = 10) {
        return $this->like('title', $query)
                        ->orLike('content', $query)
                        ->orderBy('date_created', 'DESC')
                        ->findAll($limit);
    }

    // Get the total count of news articles
    public function getTotalCount() {
        return $this->countAllResults();
    }

    // Get the count of news articles by a specific author
    public function countByAuthor($author) {
        return $this->countWhere('author', $author);
    }

    // Get the count of news articles by a specific category (if category field exists)
    public function countByCategory($category) {
        return $this->countWhere('category', $category);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MembershipModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'membership';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'name', 'price', 'comments', 'time'];
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

    // Get the latest memberships
    public function getByLatest($limit = 10) {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }

    // Get a membership by its ID
    public function getById($id) {
        return $this->find($id);
    }

    // Get a single membership by a specific column and value
    public function getBy($column, $value) {
        return $this->where($column, $value)->first();
    }

    // Get all memberships within a specific price range
    public function getByPriceRange($minPrice, $maxPrice, $limit = 10) {
        return $this->where('price >=', $minPrice)
                        ->where('price <=', $maxPrice)
                        ->orderBy('price', 'ASC')
                        ->findAll($limit);
    }

    // Get all memberships with a specific name
    public function getByName($name, $limit = 10) {
        return $this->like('name', $name)
                        ->orderBy('name', 'ASC')
                        ->findAll($limit);
    }

    // Get paginated results
    public function getPaginated($limit, $offset) {
        return $this->orderBy('created_at', 'DESC')->findAll($limit, $offset);
    }

    // Search memberships by name or comments
    public function search($query, $limit = 10) {
        return $this->like('name', $query)
                        ->orLike('comments', $query)
                        ->orderBy('created_at', 'DESC')
                        ->findAll($limit);
    }

    // Get the total count of memberships
    public function getTotalCount() {
        return $this->countAllResults();
    }

    // Get the count of memberships within a specific price range
    public function countByPriceRange($minPrice, $maxPrice) {
        return $this->where('price >=', $minPrice)
                        ->where('price <=', $maxPrice)
                        ->countAllResults();
    }

    // Get the count of memberships with a specific name
    public function countByName($name) {
        return $this->like('name', $name)->countAllResults();
    }
}

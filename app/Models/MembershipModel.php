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

    /**
     * Get all memberships.
     *
     * @return array
     */
    public function getAll() {
        return $this->findAll();
    }

    /**
     * Get a membership by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        return $this->find($id);
    }

    /**
     * Create a new membership.
     *
     * @param array $data
     * @return int|string|null
     */
    public function create(array $data) {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Update an existing membership.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateMembership($id, array $data) {
        return $this->update($id, $data);
    }

    /**
     * Delete a membership by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteMembership($id) {
        return $this->delete($id);
    }

    /**
     * Count the number of rows where a specific column matches a given value.
     *
     * @param string $column
     * @param mixed $value
     * @return int
     */
    public function countWhere($column, $value) {
        return $this->where($column, $value)->countAllResults();
    }

    /**
     * Get the latest memberships.
     *
     * @param int $limit
     * @return array
     */
    public function getByLatest($limit = 10) {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }

    /**
     * Get a single membership by a specific column and value.
     *
     * @param string $column
     * @param mixed $value
     * @return array|null
     */
    public function getBy($column, $value) {
        return $this->where($column, $value)->first();
    }

    /**
     * Get all memberships within a specific price range.
     *
     * @param float $minPrice
     * @param float $maxPrice
     * @param int $limit
     * @return array
     */
    public function getByPriceRange($minPrice, $maxPrice, $limit = 10) {
        return $this->where('price >=', $minPrice)
                        ->where('price <=', $maxPrice)
                        ->orderBy('price', 'ASC')
                        ->findAll($limit);
    }

    /**
     * Get all memberships with a specific name.
     *
     * @param string $name
     * @param int $limit
     * @return array
     */
    public function getByName($name, $limit = 10) {
        return $this->like('name', $name)
                        ->orderBy('name', 'ASC')
                        ->findAll($limit);
    }

    /**
     * Get paginated results.
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getPaginated($limit, $offset) {
        return $this->orderBy('created_at', 'DESC')->findAll($limit, $offset);
    }

    /**
     * Search memberships by name or description.
     *
     * @param string $query
     * @param int $limit
     * @return array
     */
    public function search($query, $limit = 10) {
        return $this->like('name', $query)
                        ->orLike('description', $query)
                        ->orderBy('created_at', 'DESC')
                        ->findAll($limit);
    }

    /**
     * Get the total count of memberships.
     *
     * @return int
     */
    public function getTotalCount() {
        return $this->countAllResults();
    }

    /**
     * Get the count of memberships within a specific price range.
     *
     * @param float $minPrice
     * @param float $maxPrice
     * @return int
     */
    public function countByPriceRange($minPrice, $maxPrice) {
        return $this->where('price >=', $minPrice)
                        ->where('price <=', $maxPrice)
                        ->countAllResults();
    }

    /**
     * Get the count of memberships with a specific name.
     *
     * @param string $name
     * @return int
     */
    public function countByName($name) {
        return $this->like('name', $name)->countAllResults();
    }
}

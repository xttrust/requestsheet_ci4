<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'title', 'content'];
    // Dates
    protected $useTimestamps = false;
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

    public function getAllOrderedBy($order, $by) {
        return $this->orderBy($by, $order)->asObject()->findAll();
    }

    /**
     * Retrieve all subscriptions.
     *
     * @return array
     */
    public function getAll() {
        return $this->findAll();
    }

    /**
     * Get a subscription by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        return $this->find($id);
    }

    /**
     * Insert a new subscription.
     *
     * @param array $data
     * @return int|string|null
     */
    public function create(array $data) {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Update a subscription record.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateRecord($id, array $data) {
        return $this->update($id, $data);
    }

    /**
     * Delete a subscription by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRecord($id) {
        return $this->delete($id);
    }
}

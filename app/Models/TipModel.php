<?php

namespace App\Models;

use CodeIgniter\Model;

class TipModel extends Model {

    protected $table = 'tip';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'user_id', 'name', 'url'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected array $casts = [];
    protected array $castHandlers = [];
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

    /**
     * Retrieve all tips.
     *
     * @return array
     */
    public function getAllTips() {
        return $this->findAll();
    }

    /**
     * Get a tip by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getTipById($id) {
        return $this->find($id);
    }

    /**
     * Get tips by user ID.
     *
     * @param int $userId
     * @return array
     */
    public function getTipsByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }

    /**
     * Insert a new tip.
     *
     * @param array $data
     * @return int|string|null
     */
    public function addTip(array $data) {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Update an existing tip by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateTip($id, array $data) {
        return $this->update($id, $data);
    }

    /**
     * Delete a tip by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteTip($id) {
        return $this->delete($id);
    }
}

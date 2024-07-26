<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsletterModel extends Model {

    protected $table = 'newsletter';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'date', 'email'];
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

    public function __construct() {
        parent::__construct();
    }

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
}

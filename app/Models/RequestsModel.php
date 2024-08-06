<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestsModel extends Model {

    // Define database group
    protected $DBGroup = 'default';
    // Define table name
    protected $table = 'requests';
    // Define primary key
    protected $primaryKey = 'id';
    // Enable auto-increment for the primary key
    protected $useAutoIncrement = true;
    // Return type of results
    protected $returnType = 'array';
    // Enable or disable soft deletes
    protected $useSoftDeletes = false;
    // Fields that are allowed to be inserted or updated
    protected $allowedFields = [
        'dj_id', 'name', 'email', 'comment', 'status', 'song', 'votes', 'created_at', 'updated_at', 'deleted_at'
    ];
    // Enable automatic handling of timestamps
    protected $useTimestamps = true;
    // Date format to use
    protected $dateFormat = 'datetime';
    // Define timestamp fields
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation rules
    protected $validationRules = [
        'dj_id' => 'required|integer',
        'name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|min_length[3]|max_length[255]|valid_email',
        'comment' => 'permit_empty|max_length[500]',
        'song' => 'required|min_length[3]|max_length[255]',
        'votes' => 'permit_empty|integer'
    ];
    // Validation messages
    protected $validationMessages = [];
    // Skip validation if true
    protected $skipValidation = false;
    // Clean validation rules before inserting/updating
    protected $cleanValidationRules = true;
    // Enable callbacks
    protected $allowCallbacks = true;
    // Callbacks before and after insert, update, find, and delete
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get all rows.
     *
     * @return array
     */
    public function getAll() {
        return $this->findAll();
    }

    /**
     * Get a row by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        return $this->find($id);
    }

    /**
     * Get rows by dj_id.
     *
     * @param int $djId
     * @return array
     */
    public function getByDjId($djId) {
        return $this->where('dj_id', $djId)->findAll();
    }

    /**
     * Get rows by status.
     *
     * @param string $status
     * @return array
     */
    public function getByStatus($status) {
        return $this->where('status', $status)
                        ->orderBy('created_at', 'desc')
                        ->findAll();
    }

    /**
     * Get all accepted requests sorted by created_at and votes.
     *
     * @return array
     */
    public function getAllAcceptedRequestsSorted() {
        return $this->where('status', 'accepted')
                        ->orderBy('created_at', 'desc')
                        ->orderBy('votes', 'desc')
                        ->findAll();
    }

    /**
     * Get all rows sorted by created_at and votes.
     *
     * @return array
     */
    public function getAllSortedByCreatedAtAndVotes() {
        return $this->orderBy('created_at', 'DESC')
                        ->orderBy('votes', 'DESC')
                        ->findAll();
    }

    /**
     * Deletes all rejected requests by user ID.
     *
     * @param int $userId The ID of the user whose requests are to be deleted.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function deleteByUserId($userId) {
        // Perform the delete operation
        $result = $this->where('dj_id', $userId)
                ->where('status', 'rejected')
                ->delete();

        // Return the result of the delete operation
        return $result !== false;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementsModel extends Model {

    protected $table = 'announcements'; // Corrected table name
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Soft delete enabled
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'content', 'date'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    // Date fields
    protected $useTimestamps = true; // Enable automatic timestamps
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation rules and messages
    protected $validationRules = [
        'user_id' => 'required|integer',
        'content' => 'required|min_length[3]|max_length[255]',
        'date' => 'required|valid_date'
    ];
    protected $validationMessages = [];
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
     * Get all announcements by ID
     *
     * @param int $id
     * @return array
     */
    public function getAllById(int $id): array {
        return $this->where('id', $id)->findAll();
    }

    /**
     * Get all announcements by user ID
     *
     * @param int $user_id
     * @return array
     */
    public function getAllByUserId(int $user_id): array {
        return $this->where('user_id', $user_id)->findAll();
    }

    /**
     * Count all records by a specific column and value
     *
     * @param string $column
     * @param mixed $value
     * @return int
     */
    public function countWhere(string $column, $value): int {
        return $this->where($column, $value)->orderBy('date', 'desc')->countAllResults();
    }

    /**
     * Get an announcement by its ID
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array {
        return $this->find($id);
    }

    /**
     * Get an announcement by a specific column and value
     *
     * @param string $column
     * @param mixed $value
     * @return array|null
     */
    public function getBy(string $column, $value): ?array {
        return $this->where($column, $value)->first();
    }

    /**
     * Delete an announcement by its ID
     *
     * @param int $id
     * @return bool
     */
    public function deleteRow(int $id): bool {
        return $this->delete($id);
    }

    /**
     * Get all announcements sorted by date
     *
     * @param string $order
     * @return array
     */
    public function getAllSortedByDate(string $order = 'desc'): array {
        return $this->orderBy('date', $order)->findAll();
    }

    /**
     * Get announcements with pagination
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getPaginatedAnnouncements(int $limit, int $offset): array {
        return $this->findAll($limit, $offset);
    }

    /**
     * Search announcements by content
     *
     * @param string $searchTerm
     * @return array
     */
    public function searchByContent(string $searchTerm): array {
        return $this->like('content', $searchTerm)->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'subscription';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'membership_id', 'start_date', 'end_date', 'status'];
    // Dates
    protected $useTimestamps = false;  // No timestamps in your table
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'membership_id' => 'required|integer',
        'start_date' => 'required',
        'end_date' => 'required',
        'status' => 'required|in_list[active,inactive]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function getAll() {
        return $this->findAll();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function createSubscription(array $data) {
        return $this->insert($data);
    }

    public function updateSubscription($id, array $data) {
        return $this->update($id, $data);
    }

    public function deleteSubscription($id) {
        return $this->delete($id);
    }

    /**
     * Get subscriptions by user ID.
     *
     * @param int $userId The user ID to search by.
     * @return array
     */
    public function getByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }
}

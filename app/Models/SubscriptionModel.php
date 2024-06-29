<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model {

    protected $table = 'subscription';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Set to true if using soft deletes
    protected $protectFields = true;
    protected $allowedFields = [
        'id', 'user_id', 'membership_id', 'price',
        'start_date', 'end_date', 'status'
    ]; // Adjust according to your database schema
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected array $casts = [];
    protected array $castHandlers = [];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at'; // Define if using soft deletes
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
     * Retrieve all subscriptions.
     *
     * @return array
     */
    public function getAllSubscriptions() {
        return $this->findAll();
    }

    /**
     * Get a subscription by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getSubscriptionById($id) {
        return $this->find($id);
    }

    /**
     * Get subscriptions by user ID.
     *
     * @param int $userId
     * @return array
     */
    public function getSubscriptionsByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }

    /**
     * Insert a new subscription.
     *
     * @param array $data
     * @return int|string|null
     */
    public function addSubscription(array $data) {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Update an existing subscription by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSubscription($id, array $data) {
        return $this->update($id, $data);
    }

    /**
     * Delete a subscription by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteSubscription($id) {
        return $this->delete($id);
    }
}

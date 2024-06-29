<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model {

    protected $table = 'activities';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'activity', 'details'];
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
     * Log an activity.
     *
     * @param int $userId
     * @param string $activity
     * @param array|null $details
     * @return int|string|null
     */
    public function logActivity($userId, $activity, $details = null) {
        return $this->insert([
                    'user_id' => $userId,
                    'activity' => $activity,
                    'details' => json_encode($details), // Convert details array to JSON string
        ]);
    }

    /**
     * Retrieve activities by user ID.
     *
     * @param int $userId
     * @return array
     */
    public function getActivitiesByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }
}

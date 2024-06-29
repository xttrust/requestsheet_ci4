<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model {

    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Set to true if using soft deletes
    protected $protectFields = true;
    protected $allowedFields = ['id', 'row', 'content']; // Adjust according to your database schema
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
     * Retrieve all settings.
     *
     * @return array
     */
    public function getAllSettings() {
        return $this->findAll();
    }

    /**
     * Get a setting by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getSettingById($id) {
        return $this->find($id);
    }

    /**
     * Insert a new setting.
     *
     * @param array $data
     * @return int|string|null
     */
    public function addSetting(array $data) {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Update an existing setting by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSetting($id, array $data) {
        return $this->update($id, $data);
    }

    /**
     * Delete a setting by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteSetting($id) {
        return $this->delete($id);
    }
}

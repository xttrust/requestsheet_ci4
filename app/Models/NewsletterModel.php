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

    // Method to insert a new newsletter subscription
    public function subscribe($email) {
        $data = [
            'email' => $email,
            'date' => date('Y-m-d H:i:s') // current date/time
        ];

        return $this->insert($data);
    }

    // Method to get all newsletter subscriptions
    public function getAllSubscriptions() {
        return $this->findAll();
    }

    // Method to get a single subscription by email
    public function getByEmail($email) {
        return $this->where('email', $email)->first();
    }

    // Method to update a subscription by email
    public function updateSubscription($email, $newEmail) {
        $data = ['email' => $newEmail];
        return $this->update(['email' => $email], $data);
    }

    // Method to delete a subscription by email
    public function deleteByEmail($email) {
        return $this->where('email', $email)->delete();
    }
}

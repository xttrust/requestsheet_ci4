<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model {

    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['stripe_sid', 'payment_intent', 'membership_id', 'user_id', 'amount', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [
        'stripe_sid' => 'required|max_length[255]',
        'payment_intent' => 'required|max_length[255]',
        'membership_id' => 'required|integer',
        'user_id' => 'required|integer',
        'amount' => 'required|numeric',
        'status' => 'required|in_list[pending,success,failure]'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function __construct() {
        parent::__construct();
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function getByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getByMembershipId($membershipId) {
        return $this->where('membership_id', $membershipId)->findAll();
    }

    public function getPendingPayments() {
        return $this->where('status', 'pending')->findAll();
    }

    public function createPayment($data) {
        return $this->insert($data);
    }

    public function updatePayment($id, $data) {
        return $this->update($id, $data);
    }

    public function deletePayment($id) {
        return $this->delete($id);
    }
}

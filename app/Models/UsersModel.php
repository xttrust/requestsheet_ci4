<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'username', 'hash_pass', 'email', 'first_name', 'last_name', 'role',
        'last_seen', 'token_register', 'token_lost', 'token_reset', 'status', 'register_date', 'header'
    ];
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

    public function countWhere($column, $value) {
        return $this->where($column, $value)->countAllResults();
    }

    public function getById($id) {
        return $this->where('id', $id)->first();
    }

    public function getBy($column, $value) {
        return $this->where($column, $value)->first();
    }

    public function getUserForResetPassword($token, $username) {
        return $this->where('token_reset', $token)
                        ->where('username', $username)
                        ->first();
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }
}

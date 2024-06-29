<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'title', 'content'];
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

    public function countWhere($row, $value) {
        $this->where($row, $value);
        return $this->countAllResults();
    }

    public function getByLatest() {
        return $this->orderBy('id', 'DESC')->get()->getResult();
    }

    public function getById($id) {
        return $this->where('id', $id)->get()->getRow();
    }

    public function getBy($row, $value) {
        return $this->where($row, $value)->get()->getRow();
    }
}

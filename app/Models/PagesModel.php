<?php

namespace App\Models;

use CodeIgniter\Model;

class PagesModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'position', 'status', 'body', 'slug', 'seo_title', 'seo_description', 'protected', 'custom'];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = null;
    protected $updatedField = null;
    protected $deletedField = null;
    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'slug' => 'required|min_length[3]|max_length[255]|is_unique[pages.slug]',
        'seo_title' => 'required|min_length[3]|max_length[255]',
        'seo_description' => 'required|min_length[3]|max_length[255]',
    ];
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
     * Get all pages.
     *
     * @return array
     */
    public function getAll() {
        return $this->findAll();
    }

    /**
     * Get a page by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getById($id) {
        return $this->find($id);
    }

    /**
     * Get a page by its slug.
     *
     * @param string $slug
     * @return array|null
     */
    public function getBySlug($slug) {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Get pages by status.
     *
     * @param string $status
     * @return array
     */
    public function getByStatus($status) {
        return $this->where('status', $status)->findAll();
    }
}

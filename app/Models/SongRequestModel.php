<?php

namespace App\Models;

use CodeIgniter\Model;

class SongRequestModel extends Model {

    protected $table = 'song_request';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Set to true if using soft deletes
    protected $protectFields = true;
    protected $allowedFields = [
        'id', 'user_id', 'artist_song', 'name', 'email',
        'comments', 'status', 'played', 'date', 'position'
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
     * Retrieve all song requests.
     *
     * @return array
     */
    public function getAllSongRequests() {
        return $this->findAll();
    }

    /**
     * Get a song request by its ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getSongRequestById($id) {
        return $this->find($id);
    }

    /**
     * Get song requests by user ID.
     *
     * @param int $userId
     * @return array
     */
    public function getSongRequestsByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }

    /**
     * Insert a new song request.
     *
     * @param array $data
     * @return int|string|null
     */
    public function addSongRequest(array $data) {
        $this->insert($data);
        return $this->insertID();
    }

    /**
     * Update an existing song request by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSongRequest($id, array $data) {
        return $this->update($id, $data);
    }

    /**
     * Delete a song request by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteSongRequest($id) {
        return $this->delete($id);
    }
}

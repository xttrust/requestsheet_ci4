<?php

namespace App\Controllers;

use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Requests extends BaseController {

    private $requestsModel;

    public function __construct() {
        $this->requestsModel = new RequestsModel();
    }

    /**
     * Get all requests sorted by created_at and votes
     *
     * @return ResponseInterface
     */
    public function getAllRequestsSorted() {
        $requests = $this->requestsModel
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->orderBy('votes', 'desc')
                ->findAll();
        return $this->response->setJSON(['data' => $requests]);
    }

    /**
     * Get request details by ID
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function getRequestById($id) {
        $request = $this->requestsModel->find($id);
        if ($request) {
            return $this->response->setJSON($request);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Request not found']);
        }
    }

    /**
     * Update request status
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function updateRequest($id) {
        $status = $this->request->getPost('status');
        $request = $this->requestsModel->find($id);
        if ($request) {
            $this->requestsModel->update($id, ['status' => $status]);
            return $this->response->setJSON(['message' => 'Request updated successfully']);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Request not found']);
        }
    }

    /**
     * Approve a request
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function approveRequest($id) {
        $request = $this->requestsModel->find($id);
        if ($request) {
            $this->requestsModel->update($id, ['status' => 'accepted']);
            return $this->response->setJSON(['message' => 'Request approved successfully']);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Request not found']);
        }
    }

    /**
     * Reject a request
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function rejectRequest($id) {
        $request = $this->requestsModel->find($id);
        if ($request) {
            $this->requestsModel->update($id, ['status' => 'rejected']);
            return $this->response->setJSON(['message' => 'Request rejected successfully']);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Request not found']);
        }
    }

    /**
     * Delete a request
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function deleteRequest($id) {
        $request = $this->requestsModel->find($id);
        if ($request) {
            $this->requestsModel->delete($id);
            return $this->response->setJSON(['message' => 'Request deleted successfully']);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Request not found']);
        }
    }
}

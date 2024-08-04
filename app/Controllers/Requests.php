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
     * Get all requests.
     *
     * @return ResponseInterface
     */
    public function getAllRequests(): ResponseInterface {
        $requests = $this->requestsModel->getAll();
        return $this->respond([
                    'status' => 200,
                    'data' => $requests
        ]);
    }

    /**
     * Get requests by status.
     *
     * @param string $status
     * @return ResponseInterface
     */
    public function getRequestsByStatus(string $status): ResponseInterface {
        $requests = $this->requestsModel->getByStatus($status);
        return $this->respond([
                    'status' => 200,
                    'data' => $requests
        ]);
    }

    /**
     * Get all requests sorted by created_at and votes.
     *
     * @return ResponseInterface
     */
    public function getAllRequestsSorted(): ResponseInterface {
        $requests = $this->requestsModel->getAllSortedByCreatedAtAndVotes();
        return $this->respond([
                    'status' => 200,
                    'data' => $requests
        ]);
    }

    /**
     * Return a JSON response.
     *
     * @param array $data
     * @param int $status
     * @return ResponseInterface
     */
    private function respond(array $data, int $status = 200): ResponseInterface {
        return $this->response
                        ->setStatusCode($status)
                        ->setContentType('application/json')
                        ->setBody(json_encode($data));
    }
}

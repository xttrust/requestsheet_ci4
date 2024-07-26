<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\MembershipModel;
use App\Models\SubscriptionModel; // Added to handle subscriptions

class Users extends BaseController {

    private $userModel;
    private $membershipModel;
    private $subscriptionModel; // Added to manage subscriptions

    public function __construct() {
        $this->userModel = new UsersModel();
        $this->membershipModel = new MembershipModel();
        $this->subscriptionModel = new SubscriptionModel(); // Initialize subscription model
    }

    /**
     * Display the manage users page.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function manage() {
        $data = [
            'pageTitle' => 'Administration > Users',
            'viewPath' => 'users/manage',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'users' => $this->userModel->getAllUsersOrderedBy('ASC', 'username')
        ];

        return $this->templates->backend($data);
    }

    /**
     * Display the edit user page.
     *
     * @param int|null $id The ID of the user to edit.
     * @return \CodeIgniter\HTTP\Response
     */
    public function edit($id = null) {
        if (!isset($id) || !is_numeric($id)) {
            return redirect()->to(base_url('user/manage'))->with('error', 'Invalid user ID.');
        }

        $user = $this->userModel->find($id);

        // Ensure $user is an object
        if (is_array($user)) {
            $user = (object) $user;
        }

        if (!$user) {
            return redirect()->to(base_url('user/manage'))->with('error', 'User not found.');
        }

        $user_subscription = $this->subscriptionModel->getSubscriptionsByUserId($id);
        $memberships = $this->membershipModel->findAll();

        $data = [
            'pageTitle' => 'Administration > Edit User: ' . htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'),
            'user' => $user,
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'user_subscription' => $user_subscription,
            'memberships' => $memberships,
            'errors' => \Config\Services::validation()->listErrors(),
            'alert' => session()->getFlashdata('alert'),
            'viewPath' => 'users/edit'
        ];

        return $this->templates->backend($data);
    }

    /**
     * Save the user details.
     *
     * @param int $id The ID of the user to save.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function save($id) {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('user/manage'))->with('error', 'Invalid user ID.');
        }

        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,$id]",
            'first_name' => 'required|min_length[3]|max_length[30]',
            'last_name' => 'required|min_length[3]|max_length[30]',
            'password' => 'permit_empty|min_length[6]',
            'repeat_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('user/edit/' . $id))->with('errors', $this->validator->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to(base_url('user/edit/' . $id))->with('alert', 'User details updated successfully.');
    }

    /**
     * Activate or update the user subscription.
     *
     * @param int|null $userId
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function activate_membership($userId = null) {
        if (!$userId || !is_numeric($userId)) {
            return redirect()->to(base_url('user/manage'))->with('error', 'Invalid user ID.');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(base_url('user/manage'))->with('error', 'User not found.');
        }

        $membershipId = $this->request->getPost('m_id');
        if (!$membershipId) {
            return redirect()->to(base_url('user/edit/' . $userId))->with('error', 'No membership selected.');
        }

        $membership = $this->membershipModel->find($membershipId);
        if (!$membership) {
            return redirect()->to(base_url('user/edit/' . $userId))->with('error', 'Invalid membership ID.');
        }

        $subscriptionData = [
            'user_id' => $userId,
            'membership_id' => $membershipId,
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d', strtotime("+{$membership->duration} days"))
        ];

        // Assuming that a user can have only one active subscription at a time
        $existingSubscription = $this->subscriptionModel->getSubscriptionsByUserId($userId);
        if ($existingSubscription) {
            $this->subscriptionModel->updateSubscription($existingSubscription[0]->id, $subscriptionData);
        } else {
            $this->subscriptionModel->addSubscription($subscriptionData);
        }

        return redirect()->to(base_url('user/edit/' . $userId))->with('alert', 'Subscription updated successfully.');
    }

    /**
     * Approve the user.
     *
     * @param int|null $id The ID of the user to approve.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function approve($id = null) {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('user/manage'))->with('error', 'Invalid user ID.');
        }

        // Logic to approve the user
        // Assuming you update the user's status to 'approved'
        $this->userModel->update($id, ['status' => 'approved']);

        return redirect()->to(base_url('user/manage'))->with('alert', 'User approved successfully.');
    }

    /**
     * Delete the user.
     *
     * @param int|null $id The ID of the user to delete.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id = null) {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('user/manage'))->with('error', 'Invalid user ID.');
        }

        // Check if user exists before attempting to delete
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('user/manage'))->with('error', 'User not found.');
        }

        // Delete the user
        $this->userModel->delete($id);

        return redirect()->to(base_url('user/manage'))->with('alert', 'User deleted successfully.');
    }
}

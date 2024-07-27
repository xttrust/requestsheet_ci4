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
            return redirect()->to(base_url('admin/users'))->with('fail', 'Invalid user ID.');
        }

        $user = $this->userModel->find($id);

        // Ensure $user is an object
        if (is_array($user)) {
            $user = (object) $user;
        }

        if (!$user) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'User not found.');
        }

        $user_subscription = $this->subscriptionModel->getByUserId($id);
        $memberships = $this->membershipModel->getAll();

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
        // Validate userId
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'Invalid user ID.');
        }

        // Define validation rules
        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'first_name' => 'required|min_length[3]|max_length[30]',
            'last_name' => 'required|min_length[3]|max_length[30]',
            'password' => 'permit_empty|min_length[6]',
            'repeat_password' => 'matches[password]'
        ];

        // Validate form data against rules
        if (!$this->validate($rules)) {
            return redirect()->to(base_url('admin/users/edit/' . $id))->with('errors', $this->validator->getErrors());
        }

        // Prepare user data for update

        $data = [
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'status' => $this->request->getPost('status')
        ];

        // Update password if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Update user in database
        $this->userModel->update($id, $data);

        // Redirect with success message
        return redirect()->to(base_url('admin/users/edit/' . $id))->with('success', 'User details updated successfully.');
    }

    /**
     * Activate or update the user subscription.
     *
     * @param int|null $userId
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function activateMembership($userId = null) {
        // Validate userId
        if (!$userId || !is_numeric($userId)) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'Invalid user ID.');
        }

        // Fetch user
        $user = $this->userModel->find($userId);
        if (!$user) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'User not found.');
        }

        // Validate membershipId
        $membershipId = $this->request->getPost('m_id');
        if (!$membershipId) {
            return redirect()->to(base_url('admin/users/edit/' . $userId))->with('fail', 'No membership selected.');
        }

        // Fetch membership
        $membership = $this->membershipModel->getById($membershipId);
        if (!$membership) {
            return redirect()->to(base_url('admin/users/edit/' . $userId))->with('fail', 'Invalid membership ID.');
        }

        // Check for suspension
        if ($this->request->getPost('suspend') === "Suspend") {
            $this->_suspendMembership($userId);
            return redirect()->to(base_url('admin/users/edit/' . $userId))->with('success', 'Subscription suspended successfully.');
        }

        // Get the membership duration
        $membershipDuration = isset($membership['time']) ? $membership['time'] : 0;
        $currentTime = time();
        $membershipEndTime = $currentTime + $membershipDuration;

        // Prepare subscription data
        $subscriptionData = [
            'user_id' => $userId,
            'membership_id' => $membershipId,
            'start_date' => $currentTime,
            'end_date' => $membershipEndTime
        ];

        // Check for existing subscription
        $existingSubscription = $this->subscriptionModel->where('user_id', $userId)->first();

        if ($existingSubscription) {
            // Update existing subscription
            $this->subscriptionModel->update($existingSubscription['id'], $subscriptionData);
        } else {
            // Create new subscription
            $this->subscriptionModel->insert($subscriptionData);
        }

        // Redirect with success message
        return redirect()->to(base_url('admin/users/edit/' . $userId))->with('success', 'Subscription updated successfully.');
    }

    private function _suspendMembership($userId) {
        $currentTime = time();
        $subscriptionData = [
            'end_date' => $currentTime - 100
        ];
        $this->subscriptionModel->where('user_id', $userId)->set($subscriptionData)->update();
    }

    /**
     * Approve the user.
     *
     * @param int|null $id The ID of the user to approve.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function approve($id = null) {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'Invalid user ID.');
        }

        // Logic to approve the user
        // Assuming you update the user's status to 'approved'
        $this->userModel->update($id, ['status' => 'approved']);

        return redirect()->to(base_url('admin/users'))->with('success', 'User approved successfully.');
    }

    /**
     * Delete the user.
     *
     * @param int|null $id The ID of the user to delete.
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id = null) {
        if (!$id || !is_numeric($id)) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'Invalid user ID.');
        }

        // Check if user exists before attempting to delete
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('admin/users'))->with('fail', 'User not found.');
        }

        // Delete the user
        $this->userModel->delete($id);
        $alert = 'User: <strong>' . htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') . '</strong> deleted successfully.';
        return redirect()->to(base_url('admin/users'))->with('success', $alert);
    }
}

<?php

namespace App\Controllers;

use App\Models\MembershipModel;
use CodeIgniter\HTTP\Response;

class Membership extends BaseController {

    private $membershipModel;

    public function __construct() {
        $this->membershipModel = new MembershipModel();
    }

    /**
     * Display the manage memberships page.
     *
     * @return Response
     */
    public function manage() {
        $data = [
            'pageTitle' => 'Administration > Memberships',
            'viewPath' => 'membership/manage',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'memberships' => $this->membershipModel->orderBy('id', 'ASC')->findAll()
        ];

        return $this->templates->backend($data);
    }

    /**
     * Display the form to add or edit a membership.
     *
     * @param int|null $id The ID of the membership to edit. If null, the form is for adding a new membership.
     * @return Response
     */
    public function edit($id = null) {
        // Check if it's an update.
        if ($id) {
            $membership = $this->membershipModel->getById($id);
            if (!$membership) {
                // If membership not found, redirect to the manage memberships page with an error message
                return redirect()->to('admin/membership')->with('fail', 'Membership not found.');
            }
        } else {
            $membership = false;
        }
        // Initialize data array with common elements
        $data = [
            'pageTitle' => 'Administration > Memberships',
            'viewPath' => 'membership/edit',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'membership' => $membership
        ];

        return $this->templates->backend($data);
    }

    /**
     * Handle the submission of the add/edit membership form.
     *
     * @return Response
     */
    public function save() {
        $loggedUser = $this->appSecurity->getLoggedInUser();

        // Validate input data
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|decimal',
            'time' => 'required|integer'
        ];

        if (!$this->validate($validationRules)) {
            // If validation fails, return back with errors and old input
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        $time = $this->request->getPost('time');
        $comments = $this->request->getPost('comments');

        $membershipData = [
            'name' => $name,
            'price' => $price,
            'time' => $time,
            'comments' => $comments
        ];

        if ($id) {
            // Editing an existing membership
            $membership = $this->membershipModel->getById($id);

            if (!$membership) {
                // If membership not found, redirect to the manage memberships page with an error message
                return redirect()->to('admin/membership')->with('fail', 'Membership not found.');
            }

            $this->membershipModel->updateMembership($id, $membershipData);
            $message = 'Membership updated successfully.';
            return redirect()->to('admin/membership/edit/' . $id)->with('success', $message);
        } else {
            // Adding a new membership
            $this->membershipModel->create($membershipData);
            $message = 'Membership added successfully.';
            return redirect()->to('admin/membership')->with('success', $message);
        }
    }

    /**
     * Handle the deletion of a membership.
     *
     * @param int $id The ID of the membership to delete.
     * @return Response
     */
    public function delete($id) {
        $membership = $this->membershipModel->getById($id);

        if (!$membership) {
            // If membership not found, redirect to the manage memberships page with an error message
            return redirect()->to('admin/membership')->with('fail', 'Membership not found.');
        }

        $this->membershipModel->deleteMembership($id);
        return redirect()->to('admin/membership')->with('success', 'Membership deleted successfully.');
    }
}

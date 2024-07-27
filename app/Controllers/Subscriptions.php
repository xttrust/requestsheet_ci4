<?php

namespace App\Controllers;

use App\Models\SubscriptionModel;
use CodeIgniter\HTTP\Response;

class Subscriptions extends BaseController {

    private $subscriptionModel;

    public function __construct() {
        $this->subscriptionModel = new SubscriptionModel();
    }

    /**
     * Display the manage subscriptions page.
     *
     * @return Response
     */
    public function manage() {
        $data = [
            'pageTitle' => 'Administration > Subscriptions',
            'viewPath' => 'subscriptions/manage',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'subscriptions' => $this->subscriptionModel->orderBy('id', 'ASC')->findAll()
        ];

        return $this->templates->backend($data);
    }

    /**
     * Display the form to add or edit a subscription.
     *
     * @param int|null $id The ID of the subscription to edit. If null, the form is for adding a new subscription.
     * @return Response
     */
    public function edit($id = null) {
        if ($id) {
            $subscription = $this->subscriptionModel->getById($id);
            if (!$subscription) {
                return redirect()->to('admin/subscriptions')->with('fail', 'Subscription not found.');
            }
            // Convert timestamps to YYYY-MM-DD format
            $subscription['start_date'] = date('Y-m-d', $subscription['start_date']);
            $subscription['end_date'] = date('Y-m-d', $subscription['end_date']);
        } else {
            $subscription = false;
        }

        $data = [
            'pageTitle' => 'Administration > Subscriptions',
            'viewPath' => 'subscriptions/edit',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'subscription' => $subscription
        ];

        return $this->templates->backend($data);
    }

    /**
     * Handle the submission of the add/edit subscription form.
     *
     * @return Response
     */
    public function save() {
        $loggedUser = $this->appSecurity->getLoggedInUser();

        // Validate input data
        $validationRules = [
            'user_id' => 'required|integer',
            'membership_id' => 'required|integer',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $user_id = $this->request->getPost('user_id');
        $membership_id = $this->request->getPost('membership_id');
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        $status = $this->request->getPost('status');

        $subscriptionData = [
            'user_id' => $user_id,
            'membership_id' => $membership_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
        ];

        if ($id) {
            // Editing an existing subscription
            $subscription = $this->subscriptionModel->getById($id);

            if (!$subscription) {
                return redirect()->to('admin/subscriptions')->with('fail', 'Subscription not found.');
            }

            $this->subscriptionModel->updateSubscription($id, $subscriptionData);
            $message = 'Subscription updated successfully.';
            return redirect()->to('admin/subscriptions/edit/' . $id)->with('success', $message);
        } else {
            // Adding a new subscription
            $this->subscriptionModel->createSubscription($subscriptionData);
            $message = 'Subscription added successfully.';
            return redirect()->to('admin/subscriptions')->with('success', $message);
        }
    }

    /**
     * Handle the deletion of a subscription.
     *
     * @param int $id The ID of the subscription to delete.
     * @return Response
     */
    public function delete($id) {
        $subscription = $this->subscriptionModel->getById($id);

        if (!$subscription) {
            // If subscription not found, redirect to the manage subscriptions page with an error message
            return redirect()->to('admin/subscriptions')->with('fail', 'Subscription not found.');
        }

        $this->subscriptionsModel->deleteSubscription($id);
        return redirect()->to('admin/subscriptions')->with('success', 'Subscription deleted successfully.');
    }
}

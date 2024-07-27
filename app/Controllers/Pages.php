<?php

namespace App\Controllers;

use App\Models\PagesModel;
use CodeIgniter\HTTP\Response;

class Pages extends BaseController {

    private $pagesModel;

    public function __construct() {
        $this->pagesModel = new PagesModel();
    }

    /**
     * Display the manage pages page.
     *
     * @return Response
     */
    public function manage() {
        $data = [
            'pageTitle' => 'Administration > Pages',
            'viewPath' => 'pages/manage',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'pages' => $this->pagesModel->orderBy('id', 'ASC')->findAll()
        ];

        return $this->templates->backend($data);
    }

    /**
     * Display the form to add or edit a page.
     *
     * @param int|null $id The ID of the page to edit. If null, the form is for adding a new page.
     * @return Response
     */
    public function edit($id = null) {
        $loggedUser = $this->appSecurity->getLoggedInUser();

        // Initialize data array with common elements
        $data = [
            'pageTitle' => 'Administration > Pages',
            'viewPath' => 'pages/edit',
            'loggedUser' => $loggedUser
        ];

        if ($id) {
            // Editing an existing page
            $page = $this->pagesModel->getById($id);

            if (!$page) {
                // If page not found, redirect to the page management page with an error message
                return redirect()->to('admin/pages')->with('fail', 'Page not found.');
            }

            $data['page'] = $page;
        } else {
            // Adding a new page
            $data['page'] = [
                'id' => '',
                'name' => '',
                'position' => '',
                'status' => 'active',
                'body' => '',
                'slug' => '',
                'seo_title' => '',
                'seo_description' => '',
                'protected' => 1,
                'custom' => 0
            ];
        }

        return $this->templates->backend($data);
    }

    /**
     * Handle the submission of the add/edit page form.
     *
     * @return Response
     */
    public function save() {
        $loggedUser = $this->appSecurity->getLoggedInUser();

        // Validate input data
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'slug' => 'required|min_length[3]|max_length[255]|is_unique[pages.slug]',
            'seo_title' => 'required|min_length[3]|max_length[255]',
            'seo_description' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($validationRules)) {
            // If validation fails, return back with errors and old input
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $position = $this->request->getPost('position');
        $status = $this->request->getPost('status');
        $body = $this->request->getPost('body');
        $slug = $this->request->getPost('slug');
        $seoTitle = $this->request->getPost('seo_title');
        $seoDescription = $this->request->getPost('seo_description');
        $protected = $this->request->getPost('protected') ? 1 : 0;
        $custom = $this->request->getPost('custom') ? 1 : 0;

        $pageData = [
            'name' => $name,
            'position' => $position,
            'status' => $status,
            'body' => $body,
            'slug' => $slug,
            'seo_title' => $seoTitle,
            'seo_description' => $seoDescription,
            'protected' => $protected,
            'custom' => $custom
        ];

        if ($id) {
            // Editing an existing page
            $page = $this->pagesModel->getById($id);

            if (!$page) {
                // If page not found, redirect to the page management page with an error message
                return redirect()->to('admin/pages')->with('fail', 'Page not found.');
            }

            $this->pagesModel->update($id, $pageData);
            $message = 'Page updated successfully.';
            return redirect()->to('admin/pages/edit/' . $id)->with('success', $message);
        } else {
            // Adding a new page
            $this->pagesModel->insert($pageData);
            $message = 'Page added successfully.';
            return redirect()->to('admin/pages')->with('success', $message);
        }
    }

    /**
     * Handle the deletion of a page.
     *
     * @param int $id The ID of the page to delete.
     * @return Response
     */
    public function delete($id) {
        $page = $this->pagesModel->getById($id);

        if (!$page) {
            // If page not found, redirect to the page management page with an error message
            return redirect()->to('admin/pages')->with('fail', 'Page not found.');
        }

        $this->pagesModel->delete($id);
        return redirect()->to('admin/pages')->with('success', 'Page deleted successfully.');
    }
}

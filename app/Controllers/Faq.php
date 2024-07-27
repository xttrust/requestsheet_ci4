<?php

namespace App\Controllers;

use App\Models\FaqModel;
use CodeIgniter\HTTP\Response;

class Faq extends BaseController {

    private $faqModel;

    public function __construct() {
        $this->faqModel = new FaqModel();
    }

    /**
     * Display the manage FAQs page.
     *
     * @return Response
     */
    public function manage() {
        $data = [
            'pageTitle' => 'Administration > FAQ',
            'viewPath' => 'faq/manage',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'faqs' => $this->faqModel->orderBy('id', 'ASC')->findAll()
        ];

        return $this->templates->backend($data);
    }

    /**
     * Display the form to add or edit an FAQ.
     *
     * @param int|null $id The ID of the FAQ to edit. If null, the form is for adding a new FAQ.
     * @return Response
     */
    public function edit($id = null) {
        if ($id) {
            $faq = $this->faqModel->find($id);
            if (!$faq) {
                return redirect()->to('admin/faq')->with('fail', 'FAQ not found.');
            }
        } else {
            $faq = null;
        }

        $data = [
            'pageTitle' => 'Administration > FAQ',
            'viewPath' => 'faq/edit',
            'loggedUser' => $this->appSecurity->getLoggedInUser(),
            'faq' => $faq
        ];

        return $this->templates->backend($data);
    }

    /**
     * Handle the submission of the add/edit FAQ form.
     *
     * @return Response
     */
    public function save() {
        $loggedUser = $this->appSecurity->getLoggedInUser();

        $validationRules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[5]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $faqData = [
            'title' => $title,
            'content' => $content
        ];

        if ($id) {
            $faq = $this->faqModel->find($id);
            if (!$faq) {
                return redirect()->to('admin/faq')->with('fail', 'FAQ not found.');
            }

            $this->faqModel->update($id, $faqData);
            return redirect()->to('admin/faq/edit/' . $id)->with('success', 'FAQ updated successfully.');
        } else {
            $this->faqModel->insert($faqData);
            return redirect()->to('admin/faq')->with('success', 'FAQ added successfully.');
        }
    }

    /**
     * Handle the deletion of an FAQ.
     *
     * @param int $id The ID of the FAQ to delete.
     * @return Response
     */
    public function delete($id) {
        $faq = $this->faqModel->find($id);

        if (!$faq) {
            return redirect()->to('admin/faq')->with('fail', 'FAQ not found.');
        }

        $this->faqModel->delete($id);
        return redirect()->to('admin/faq')->with('success', 'FAQ deleted successfully.');
    }
}

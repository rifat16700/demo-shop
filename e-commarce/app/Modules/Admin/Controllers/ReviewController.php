<?php

namespace Admin\Controllers;

use Admin\Controllers\AdminController;

class ReviewController extends AdminController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Handle Delete
        if ($this->request->getGet('delete')) {
            $id = (int)$this->request->getGet('delete');
            $db->table('reviews')->where('id', $id)->delete();
            return redirect()->to(admin_url('reviews'))->with('success', 'Review deleted successfully.');
        }

        // Handle Status Update
        if ($this->request->getGet('status') !== null && $this->request->getGet('id')) {
            $id = (int)$this->request->getGet('id');
            $status = (int)$this->request->getGet('status');
            $db->table('reviews')->where('id', $id)->update(['status' => $status]);
            return redirect()->to(admin_url('reviews'))->with('success', 'Review status updated successfully.');
        }

        $reviews = $db->table('reviews')->orderBy('id', 'DESC')->get()->getResultArray();

        $data = [
            'title' => 'Manage Reviews',
            'items' => $reviews
        ];

        return $this->template->view('reviews/index', $data)->render();
    }
}

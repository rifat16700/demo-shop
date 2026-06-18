<?php

namespace User\Controllers;

use User\Controllers\BaseController;

class ReviewController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        if ($this->request->getMethod() === 'post') {
            $rating = (int)$this->request->getPost('rating');
            $comment = trim($this->request->getPost('comment'));
            $user_id = session('uid');
            
            // Get user's name
            $user = $db->table('users')->where('id', $user_id)->get()->getRow();
            $name = $user ? $user->first_name . ' ' . $user->last_name : 'User';

            if ($rating < 1 || $rating > 5) {
                return redirect()->back()->with('error', 'Please select a valid rating.');
            }
            if (empty($comment)) {
                return redirect()->back()->with('error', 'Please write a comment.');
            }

            $data = [
                'user_id' => $user_id,
                'name' => trim($name),
                'rating' => $rating,
                'comment' => $comment,
                'status' => 0, // Pending
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $db->table('reviews')->insert($data);
            return redirect()->back()->with('success', 'Thank you! Your review has been submitted and is pending approval.');
        }

        // Fetch user's previous reviews
        $my_reviews = $db->table('reviews')->where('user_id', session('uid'))->orderBy('id', 'DESC')->get()->getResultArray();

        $data = [
            'title' => 'Write a Review',
            'my_reviews' => $my_reviews
        ];

        return $this->template->view('reviews/index', $data)->render();
    }
}

<?php

namespace App\Repositories;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getPostComments($postId);
    public function getUserComments($userId);
}

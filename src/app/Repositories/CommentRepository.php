<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function all()
    {
        return Comment::with(['user', 'post'])->get();
    }

    public function find($id)
    {
        return Comment::with(['user', 'post'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update($id, array $data)
    {
        $comment = $this->find($id);
        $comment->update($data);
        return $comment;
    }

    public function delete($id)
    {
        $comment = $this->find($id);
        return $comment->delete();
    }

    public function getPostComments($postId)
    {
        return Comment::where('post_id', $postId)->get();
    }

    public function getUserComments($userId)
    {
        return Comment::where('user_id', $userId)->get();
    }
}

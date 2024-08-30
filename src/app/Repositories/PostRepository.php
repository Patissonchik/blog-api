<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function all()
    {
        return Post::with('comments.user')->get();
    }

    public function find($id)
    {
        return Post::with('comments.user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        return $post->delete();
    }

    public function getComments($postId)
    {
        return Post::findOrFail($postId)->comments;
    }
}

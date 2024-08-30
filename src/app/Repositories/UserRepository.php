<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::with(['posts', 'comments'])->get();
    }

    public function find($id)
    {
        return User::with(['posts', 'comments'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }

    public function getPosts($userId)
    {
        return User::findOrFail($userId)->posts;
    }

    public function getComments($userId)
    {
        return User::findOrFail($userId)->comments;
    }
}

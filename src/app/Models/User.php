<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Иван Иванов"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-28T15:07:03Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-28T15:07:03Z"),
 * )
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

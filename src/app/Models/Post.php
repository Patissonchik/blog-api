<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post Model",
 *     description="Модель поста",
 *     @OA\Property(property="id", type="integer", example=1, description="ID поста"),
 *     @OA\Property(property="user_id", type="integer", example=1, description="ID пользователя, создавшего пост"),
 *     @OA\Property(property="body", type="string", description="Содержимое поста"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-28T15:07:03Z", description="Дата и время создания"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-28T15:07:03Z", description="Дата и время последнего обновления"),
 * )
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

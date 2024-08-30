<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Comment",
 *     type="object",
 *     title="Comment Model",
 *     description="Модель комментария",
 *     @OA\Property(property="id", type="integer", example=1, description="ID комментария"),
 *     @OA\Property(property="post_id", type="integer", example=1, description="ID поста, к которому относится комментарий"),
 *     @OA\Property(property="user_id", type="integer", example=1, description="ID пользователя, оставившего комментарий"),
 *     @OA\Property(property="body", type="string", description="Содержимое комментария"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-28T15:07:03Z", description="Дата и время создания"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-28T15:07:03Z", description="Дата и время последнего обновления"),
 * )
 */

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'body'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php
namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

/**
*
*
* Tag для комментариев
* @OA\Tag(
*     name="Comments",
*     description="Комментарии"
* )
*/
class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @OA\Get(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     summary="Получить список комментариев",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ"
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->commentService->getAllComments());
    }

    /**
     * @OA\Get(
     *     path="/api/comments/{id}",
     *     tags={"Comments"},
     *     summary="Получить комментарий по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID комментария",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комментарий не найден"
     *     )
     * )
     */
    public function show($id)
    {
        return response()->json($this->commentService->getCommentById($id));
    }

    /**
     * @OA\Post(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     summary="Создать комментарий",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Комментарий создан"
     *     )
     * )
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = $this->commentService->createComment($request->validated());
        return response()->json($comment, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     tags={"Comments"},
     *     summary="Обновить комментарий",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID комментария",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Комментарий обновлён"
     *     )
     * )
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = $this->commentService->updateComment($id, $request->validated());
        return response()->json($comment);
    }

    /**
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     tags={"Comments"},
     *     summary="Удалить комментарий",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID комментария",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Комментарий успешно удалён"
     *     )
     * )
     */
    public function destroy($id)
    {
        $this->commentService->deleteComment($id);
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{postId}/comments",
     *     tags={"Comments"},
     *     summary="Получить комментарии по ID поста",
     *     @OA\Parameter(
     *         name="postId",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ"
     *     )
     * )
     */
    public function commentsForPost($postId)
    {
        return response()->json($this->commentService->getCommentsForPost($postId));
    }

    /**
     * @OA\Get(
     *     path="/api/users/{userId}/comments",
     *     tags={"Comments"},
     *     summary="Получить комментарии по ID пользователя",
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ"
     *     )
     * )
     */
    public function commentsForUser($userId)
    {
        return response()->json($this->commentService->getCommentsForUser($userId));
    }
}

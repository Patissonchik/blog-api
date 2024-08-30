<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

/**
 *
 *
 * Tag для постов
 * @OA\Tag(
 *     name="Posts",
 *     description="Управление постами"
 * )
 */
class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Получить список всех постов",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->postService->getAllPosts());
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Получить пост по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=404, description="Пост не найден")
     * )
     */
    public function show($id)
    {
        return response()->json($this->postService->getPostById($id));
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="Создать новый пост",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Пост успешно создан",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->postService->createPost($request->validated());
        return response()->json($post, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Обновить пост",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Пост успешно обновлён",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(response=404, description="Пост не найден")
     * )
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postService->updatePost($id, $request->validated());
        return response()->json($post);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     summary="Удалить пост",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID поста",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Пост успешно удалён"
     *     ),
     *     @OA\Response(response=404, description="Пост не найден")
     * )
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return response()->json(null, 204);
    }


    public function comments($postId)
    {
        return response()->json($this->postService->getCommentsForPost($postId));
    }
}

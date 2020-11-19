<?php

namespace Modules\Messaging;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Faker\Factory;


class ChatController
{
    /**
     * @OA\Post(
     *     path="/api/v1/messaging/chats/create",
     *     tags={"Личные сообщения"},
     *     description="Создать чат",
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     requestBody={ "required": true, "content": { "application/json": { "schema": { "$ref":  "#/components/schemas/Chat" } } } },
     *     @OA\Response(
     *         response="201", 
     *         description="Чат создан",
     *     ),
     *     @OA\Response(
     *         response="400", 
     *         description="Ошибка создания",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors", 
     *                 description="Ошибки",
     *                 type="array", 
     *                 @OA\Items(
     *                     type="string",
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401", 
     *         description="Пользователь неавторизован",
     *     )
     * )
     */
    public function createChat(Request $request)
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/messaging/chats",
     *     tags={"Личные сообщения"},
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Диалоги пользователя",
     *         @OA\JsonContent(
     *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Chat")),
     *             @OA\Property(property="page", type="integer"),
     *             @OA\Property(property="pages", type="integer")
     *         )
     *     )
     * )
     */
    public function chats(Request $request)
    {

        $faker = Factory::create('ru_RU');

        $page = $request->query->get('page', 1);

        $response = [
            "items" => [],
            "page" => $page,
            "pages" => 10
        ];

        for ($i = 0; $i < 10; $i++) {
            $response["items"][] = Models\Chat::fake($faker);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/messaging/messages",
     *     tags={"Личные сообщения"},
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     @OA\Parameter(
     *         name="chatId",
     *         description="ID чата",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Сообщения в диалоге",
     *         @OA\JsonContent(
     *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Message")),
     *             @OA\Property(property="page", type="integer"),
     *             @OA\Property(property="pages", type="integer")
     *         )
     *     )
     * )
     */
    public function messages(Request $request)
    {

        $faker = Factory::create('ru_RU');

        $page = $request->query->get('page', 1);

        $response = [
            "items" => [],
            "page" => $page,
            "pages" => 10
        ];

        $users = [Models\User::fake($faker), Models\User::fake($faker)];

        for ($j = 0; $j < 10; $j++) {
            $message = Models\Message::fake($faker);
            $message->author = $faker->randomElement($users);
            $response["items"][] = $message;
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }
}
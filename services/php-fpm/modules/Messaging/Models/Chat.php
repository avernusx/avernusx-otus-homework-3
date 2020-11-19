<?php

namespace Modules\Messaging\Models;

/**
 * @OA\Schema()
 */
class Chat
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     */
    public string $id;

    /**
     * Сообщения
     * @var Message[]
     * @OA\Property()
     */
    public array $messages = [];

    /**
     * Пользователи
     * @var User[]
     * @OA\Property()
     */
    public array $users = [];

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker)
    {
        $users = [User::fake($faker), User::fake($faker)];

        $messages = [Message::fake($faker)];

        return new Chat([
            "id" => $faker->uuid,
            "messages" => $messages,
            "users" => $users
        ]);
    }
}
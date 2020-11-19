<?php

namespace Modules\Messaging\Models;

use \Datetime;

/**
 * @OA\Schema()
 */
class Message
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     */
    public string $id;

    /**
     * Дата отправки
     * @var DateTime
     * @OA\Property()
     */
    public DateTime $date;

    /**
     * Текст сообщения
     * @var string
     * @OA\Property()
     */
    public string $text;

    /**
     * Отправитель
     * @var User
     * @OA\Property()
     */
    public User $author;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker)
    {
        return new Message([
            "id" => $faker->uuid,
            "author" => User::fake($faker),
            "text" => $faker->text($maxNbChars = 200),
            "date" => $faker->dateTimeThisCentury()
        ]);
    }
}
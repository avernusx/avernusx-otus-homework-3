<?php

namespace Modules\Messaging\Models;

use Modules\Profile\Models\Picture;


/**
 * @OA\Schema()
 */
class User
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     */
    public string $id;

    /**
     * Имя
     * @var string
     * @OA\Property()
     */
    public string $name;

    /**
     * Аватар
     * @var Picture
     * @OA\Property()
     */
    public Picture $photo;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker)
    {
        return new User([
            "id" => $faker->uuid,
            "picture" => Picture::fake($faker, $width=60, $height=60),
            "name" => $faker->name
        ]);
    }
}
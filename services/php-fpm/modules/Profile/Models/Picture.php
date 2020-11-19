<?php

namespace Modules\Profile\Models;

/**
 * @OA\Schema()
 */
class Picture
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     */
    public string $id;

    /**
     * Абсолютный УРЛ изображения
     * @var string
     * @OA\Property()
     */
    public string $url;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker, $width=640, $height=640)
    {
        return new Picture([
            "id" => $faker->uuid,
            "url" => $faker->imageUrl($width, $height)
        ]);
    }
}
<?php

namespace Modules\Profile\Models;

/**
 * @OA\Schema()
 */
class Drink
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     */
    public string $id;

    /**
     * Название напитка
     * @var string
     * @OA\Property()
     */
    public string $title;

    /**
     * Иконка
     * @var Picture
     * @OA\Property()
     */
    public Picture $picture;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker)
    {
        return new Drink([
            "id" => $faker->uuid,
            "picture" => Picture::fake($faker, $width=30, $height=30),
            "title" => $faker->randomElement([
                'водка', 
                'пиво', 
                'вино', 
                'коктейли',
                'виски',
                'настойки',
                'абсент',
                'текила',
                'ликер',
                'спирт',
                'самогон',
                'бормотуха',
                'синька',
                'бренди',
                'бурбон',
                'джин',
                'ром',
                'портвейн',
                'шампанское',
                'сидр',
                'эль',
                'херес',
            ]),
        ]);
    }
}
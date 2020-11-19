<?php

namespace Modules\Profile\Models;

/**
 * @OA\Schema()
 * @Entity
 * @Table(name="profile_hobby")
 */
class Hobby
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     * @Column(type="guid")
     * @Id
     */
    public string $id;

    /**
     * Название увлечения
     * @var string
     * @OA\Property()
     * @Column(type="string")
     */
    public string $title;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker)
    {
        return new Hobby([
            "id" => $faker->uuid,
            "title" => $faker->randomElement([
                'футбол', 
                'хоккей', 
                'компьютерные игры', 
                'настольные игры',
                'тачки',
                'путешествия',
                'философия',
                'политика',
                'стрельба',
                'рыбалка',
                'шоппинг',
                'тикток',
                'сартр',
                'ницше',
                'фентези',
                'дарья донцова',
                'кошки',
                'собаки',
                'папуги',
                'мемы',
                'прогулки',
                'кино',
            ]),
        ]);
    }
}
<?php

namespace Modules\Profile\Models;

use \Datetime;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\Schema()
 */
class Profile 
{
    /**
     * UUID
     * @var string
     * @OA\Property()
     */
    public string $id;

    /**
     * Фамилия-имя-отчество
     * @var string
     * @OA\Property()
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * Дата рождения
     * @var DateTime
     * @OA\Property()
     */
    public DateTime $birthdate;

    /**
     * Пол М/Ж
     * @var string
     * @OA\Property()
     */
    public string $sex;

    /**
     * Место работы
     * @var string
     * @OA\Property()
     */
    public string $work;

    /**
     * Должность
     * @var string
     * @OA\Property()
     */
    public string $position;

    /**
     * Семейное положение
     * @var string
     * @OA\Property()
     */
    public string $family;

    /**
     * Цель посещения
     * @var string
     * @OA\Property()
     */
    public string $status;

    /**
     * Предпочитаемые закуски
     * @var string
     * @OA\Property()
     */
    public string $snacks;

    /**
     * О себе
     * @var string
     * @OA\Property()
     */
    public string $about;

    /**
     * Рейтинг (от 0 до 100)
     * @var int
     * @OA\Property()
     */
    public int $rating;

    /**
     * Фотографии
     * @var Picture[]
     * @OA\Property()
     */
    public $photos = [];

    /**
     * Предпочитаемый алкоголь
     * @var Drink[]
     * @OA\Property()
     */
    public $drinks = [];

    /**
     * Увлечения
     * @var Hobby[]
     * @OA\Property()
     */
    public array $hobby = [];

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function fake($faker)
    {
        $photos = [];
        $drinks = [];
        $hobby  = [];

        $i = random_int(1, 6);

        for ($j = 0; $j < $i; $j++) {
            $drinks[] = Drink::fake($faker);
        }

        $i = random_int(1, 6);

        for ($j = 0; $j < $i; $j++) {
            $photos[] = Picture::fake($faker);
        }

        $i = random_int(1, 6);

        for ($j = 0; $j < $i; $j++) {
            $hobby[] = Hobby::fake($faker);
        }

        return new Profile([
            "id" => $faker->uuid,
            "name" => $faker->name,
            "birthdate" => $faker->dateTimeThisCentury(),
            "sex" => $faker->randomElement(['М', 'Ж']),
            "work" => $faker->company,
            "position" => $faker->jobTitle,
            "family" => $faker->randomElement(['холост', 'в отношениях', 'женат(замужем)', 'разведен(а)']),
            "status" => $faker->sentence($nbWords = 6),
            "about" => $faker->text($maxNbChars = 200),
            "snacks" => $faker->sentence($nbWords = 3),
            "rating" => $faker->numberBetween(0, 100),
            "photos" => $photos,
            "drinks" => $drinks,
            "hobby" => $hobby
        ]);
    }
}
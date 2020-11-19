<?php

namespace Modules\Profile\Models;

/**
 * @OA\Schema()
 */
class ConviveProfile extends Profile
{
    /**
     * Он лайкнул меня
     * @var bool
     * @OA\Property()
     */
    public bool $likeFrom = false;

    /**
     * Я лайкнул его
     * @var bool
     * @OA\Property()
     */
    public bool $likeTo = false;

    public function __construct($data)
    {
        parent::__construct($data);
    }

    public static function fake($faker)
    {
        $item = parent::fake($faker);
        $item->likeFrom = $faker->boolean;
        $item->likeTo = $faker->boolean;
        return $item;
    }
}
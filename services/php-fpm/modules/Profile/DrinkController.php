<?php

namespace Modules\Profile;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Faker\Factory;

use \Modules\Core\Controller;


/**
 * @OA\Get(
 *     path="/api/v1/profile/drinks",
 *     tags={"Справочники"},
 *     @OA\Response(
 *         response="200", 
 *         description="Список алкоголя",
 *         @OA\JsonContent(
 *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Drink")),
 *             @OA\Property(property="page", type="integer"),
 *             @OA\Property(property="pages", type="integer")
 *         )
 *     )
 * )
 */
class DrinkController
{
    public function index(Request $request)
    {

        $faker = Factory::create('ru_RU');

        $page = $request->query->get('page', 1);

        $response = [
            "items" => [],
            "page" => $page,
            "pages" => 10
        ];

        for ($i = 0; $i < 10; $i++) {
            $response["items"][] = Models\Drink::fake($faker);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }
}
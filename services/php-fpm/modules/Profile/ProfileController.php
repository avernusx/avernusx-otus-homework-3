<?php

namespace Modules\Profile;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Faker\Factory;



class ProfileController
{
    /**
     * @OA\Get(
     *     path="/api/v1/profile/convives/search",
     *     tags={"Профили пользователей"},
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     @OA\Parameter(
     *         name="city",
     *         description="ID города",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Parameter(
     *         name="ageFrom",
     *         description="Возраст от",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Parameter(
     *         name="ageFrom",
     *         description="Возраст от",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Parameter(
     *         name="ageTo",
     *         description="Возраст до",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Parameter(
     *         name="sex",
     *         description="Пол",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Parameter(
     *         name="family",
     *         description="Семейное положение",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Parameter(
     *         name="drinks",
     *         description="ID алкоголя, может быть несколько, разделяются запятыми",
     *         in="query",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *             )
     *         )     
     *     ),
     *     @OA\Parameter(
     *         name="hobby",
     *         description="ID увлечений, может быть несколько, разделяются запятыми",
     *         in="query",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *             )
     *         )     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Поиск подходящих собутыльников",
     *         @OA\JsonContent(
     *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Profile")),
     *             @OA\Property(property="page", type="integer"),
     *             @OA\Property(property="pages", type="integer")
     *         )
     *     )
     * )
     */
    public function convives(Request $request)
    {

        $faker = Factory::create('ru_RU');

        $page = $request->query->get('page', 1);

        $response = [
            "items" => [],
            "page" => $page,
            "pages" => 10
        ];

        for ($i = 0; $i < 10; $i++) {
            $response["items"][] = Models\Profile::fake($faker);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/profile/convives/set-like",
     *     tags={"Профили пользователей"},
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         description="ID пользователя, которому ставят лайк",
     *         type="string",
     *         in="query"     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Лайкнуть пользователя",
     *     ),
     *     @OA\Response(
     *         response="404", 
     *         description="Пользователь не найден",
     *     )
     * )
     */
    public function setLike(Request $request)
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse([]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/profile/convives/liked-me",
     *     tags={"Профили пользователей"},
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         in="header"     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Собутыльники, которые лайкнули меня",
     *         @OA\JsonContent(
     *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/ConviveProfile")),
     *             @OA\Property(property="page", type="integer"),
     *             @OA\Property(property="pages", type="integer")
     *         )
     *     )
     * )
     */
    public function likedMe(Request $request)
    {

        $faker = Factory::create('ru_RU');

        $page = $request->query->get('page', 1);

        $response = [
            "items" => [],
            "page" => $page,
            "pages" => 10
        ];

        for ($i = 0; $i < 10; $i++) {
            $item = Models\ConviveProfile::fake($faker);
            $item->likeFrom = true;
            $response["items"][] = $item;
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/profile/convives/liked-by-me",
     *     tags={"Профили пользователей"},
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Собутыльники, которых я лайкнул",
     *         @OA\JsonContent(
     *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/ConviveProfile")),
     *             @OA\Property(property="page", type="integer"),
     *             @OA\Property(property="pages", type="integer")
     *         )
     *     )
     * )
     */
    public function likedByMe(Request $request)
    {

        $faker = Factory::create('ru_RU');

        $page = $request->query->get('page', 1);

        $response = [
            "items" => [],
            "page" => $page,
            "pages" => 10
        ];

        for ($i = 0; $i < 10; $i++) {
            $item = Models\ConviveProfile::fake($faker);
            $item->likeTo = true;
            $response["items"][] = $item;
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }
}
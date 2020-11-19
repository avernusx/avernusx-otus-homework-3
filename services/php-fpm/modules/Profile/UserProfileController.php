<?php

namespace Modules\Profile;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Faker\Factory;

use \Modules\Core\Controller;
use \Modules\Core\JsonRequest;


class UserProfileController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/profile/create",
     *     tags={"Личный кабинет"},
     *     description="Создать профиль",
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     requestBody={ "required": true, "content": { "application/json": { "schema": { "$ref":  "#/components/schemas/Profile" } } } },
     *     @OA\Response(
     *         response="201", 
     *         description="Профиль создан",
     *     ),
     *     @OA\Response(
     *         response="400", 
     *         description="Ошибка заполнения профиля",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors", 
     *                 description="Ошибки",
     *                 type="array", 
     *                 @OA\Items(
     *                     type="string",
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401", 
     *         description="Пользователь неавторизован",
     *     )
     * )
     */
    public function create(JsonRequest $request)
    {
        $user = new Models\Profile($request->getJson());
        $errors = $this->validator->validate($user);

        if (count($errors) > 0) return $this->sendErrors($errors);
 
        return new \Symfony\Component\HttpFoundation\JsonResponse([]);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/profile/update",
     *     tags={"Личный кабинет"},
     *     description="Обновить профиль",
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     requestBody={ "required": true, "content": { "application/json": { "schema": { "$ref":  "#/components/schemas/Profile" } } } },
     *     @OA\Response(
     *         response="200", 
     *         description="Профиль обновлен",
     *     ),
     *     @OA\Response(
     *         response="400", 
     *         description="Ошибка заполнения профиля",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors", 
     *                 description="Ошибки",
     *                 type="array", 
     *                 @OA\Items(
     *                     type="string",
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="401", 
     *         description="Пользователь неавторизован",
     *     )
     * )
     */
    public function update(Request $request)
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse([]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/profile/view",
     *     tags={"Личный кабинет"},
     *     description="Просмотреть профиль",
     *     @OA\Parameter(
     *         name="token",
     *         description="Токен доступа пользователя",
     *         type="string",
     *         in="header"     
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="Просмотр профиля",
     *         @OA\JsonContent(ref="#/components/schemas/ConviveProfile")
     *     )
     * )
     */
    public function view(Request $request)
    {
        $faker = Factory::create('ru_RU');

        return new \Symfony\Component\HttpFoundation\JsonResponse(Models\ConviveProfile::fake($faker));
    }
}
<?php

namespace Modules\Profile;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Faker\Factory;

use \Modules\Core\Controller;


/**
 * @OA\Get(
 *     path="/api/v1/profile/hobby",
 *     tags={"Справочники"},
 *     @OA\Response(
 *         response="200", 
 *         description="Список увлечений",
 *         @OA\JsonContent(
 *             @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Hobby")),
 *             @OA\Property(property="page", type="integer"),
 *             @OA\Property(property="pages", type="integer")
 *         )
 *     )
 * )
 */
class HobbyController extends Controller
{
    public function index(Request $request)
    {
        $repository = $this->entityManager->getRepository('Modules\Profile\Models\Hobby');
        $hobbies = $repository->findAll();

        $page = $request->query->get('page', 1);

        $response = [
            "items" => $hobbies,
            "page" => $page,
            "pages" => 10
        ];

        return new \Symfony\Component\HttpFoundation\JsonResponse($response);
    }
}
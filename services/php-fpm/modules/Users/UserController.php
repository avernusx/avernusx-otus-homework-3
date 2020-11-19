<?php

namespace Modules\Users;

use \Symfony\Component\HttpFoundation\JsonResponse;
use \Modules\Core\JsonRequest;
use \Modules\Core\Controller;

use Modules\Users\Models\User;

class UserController extends Controller
{
    public function list(JsonRequest $request) : JsonResponse
    {

    }

    public function create(JsonRequest $request) : JsonResponse
    {
        $user = new Models\User($request->getJson());
        $errors = $this->validator->validate($user);
        if (count($errors)) return $this->sendErrors($errors);

        $service = new Services\UserService($this->entityManager);
        $userExists = $service->userExists($user);

        $response = [
            "errors" => []
        ];

        if ($userExists) {
            if ($userExists->login == $user->login) $response["errors"]["login"] = "Пользователь с таким логином уже существует";
            if ($userExists->email == $user->email) $response["errors"]["email"] = "Пользователь с такой электронной почтой уже существует";
            return new JsonResponse($response, 403);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        return new JsonResponse($user);
    }

    public function update(JsonRequest $request, array $currentRoute) : JsonResponse
    {
        $user = $this->entityManager->find('Modules\Users\Models\User', $currentRoute["id"]);
        if (!$user) return new JsonResponse([], 404);
        $user = new User($request->getJson());

        $errors = $this->validator->validate($user);
        if (count($errors) > 0) return $this->sendErrors($errors);
        
        $user->id = $currentRoute["id"];

        $service = new Services\UserService($this->entityManager);
        $userExists = $service->userExists($user);

        $response = [
            "errors" => []
        ];

        if ($userExists) {
            if ($userExists->login == $user->login && $user->id !== $userExists->id) $response["errors"]["login"] = "Пользователь с таким логином уже существует";
            if ($userExists->email == $user->email && $user->id !== $userExists->id) $response["errors"]["email"] = "Пользователь с такой электронной почтой уже существует";
            if (count($response["errors"]) > 0) return new JsonResponse($response, 403);
        }

        $this->entityManager->merge($user);
        $this->entityManager->flush();

        return new JsonResponse($user);
    }

    public function view(JsonRequest $request, array $currentRoute) : JsonResponse
    {
        $user = $this->entityManager->find('Modules\Users\Models\User', $currentRoute["id"]);
        if (!$user) return new JsonResponse([], 404);
        return new JsonResponse($user);
    }

    public function delete(JsonRequest $request, array $currentRoute) : JsonResponse
    {
        $user = $this->entityManager->find('Modules\Users\Models\User', $currentRoute["id"]);
        if (!$user) return new JsonResponse([], 404);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return new JsonResponse([]);
    }

    public function signin(JsonRequest $request) : JsonResponse
    {
        return new JsonResponse([]);
    }

    public function signout(JsonRequest $request) : JsonResponse
    {
        return new JsonResponse([]);
    }
}
<?php

namespace Modules\Core;

use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\Validator\ConstraintViolationList;

class Controller
{
    protected $entityManager;
    protected $validator;

    public function __construct($entityManager, $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function sendErrors(ConstraintViolationList $errors) : JsonResponse
    {
        $response = [
            "errors" => []
        ];

        foreach($errors as $error) {
            $response["errors"][$error->getPropertyPath()] = $error->getMessage();
        }

        return new JsonResponse($response, 403);
    }
}
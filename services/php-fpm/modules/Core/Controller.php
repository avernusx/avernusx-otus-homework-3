<?php

namespace Modules\Core;

use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\Validator\ConstraintViolationList;

class Controller
{
    protected $entityManager;
    protected $validator;
    protected $prometheus;

    public function __construct($entityManager, $validator, $prometheus)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->prometheus = $prometheus;
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
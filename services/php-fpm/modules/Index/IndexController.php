<?php

namespace Modules\Index;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;


class IndexController
{
    public function health(Request $request)
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse([
          "status" => "OK"
        ]);
    }
}
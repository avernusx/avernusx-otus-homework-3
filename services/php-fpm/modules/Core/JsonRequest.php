<?php

namespace Modules\Core;

use \Symfony\Component\HttpFoundation\Request;

class JsonRequest extends Request
{
    public function getJson()
    {
        $parametersAsArray = [];
        if ($content = $this->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        return $parametersAsArray;
    }
}
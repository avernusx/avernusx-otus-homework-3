<?php

namespace Modules\Index;

class Controller
{
    public function status()
    {
        return new Response(
            'OK'
        );
    }
}
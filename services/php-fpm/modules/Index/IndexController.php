<?php

namespace Modules\Index;

use \Modules\Core\Controller;

class IndexController extends Controller
{
    public function status()
    {
        return new Response(
            'OK'
        );
    }

    public function metrics()
    {
        $renderer = new \Prometheus\RenderTextFormat();
        $result = $renderer->render($this->prometheus->getMetricFamilySamples());
        header('Content-type: ' . \Prometheus\RenderTextFormat::MIME_TYPE);
        echo $result;
        exit();
    }

    public function error500()
    {
        throw new \Exception("500 ошибка");
    }
}
<?php

namespace Bavix\App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array
     */
    protected $cookies = [];

    /**
     * @param string $mixed
     * @param array  $data
     * @param array  $merge
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \InvalidArgumentException
     */
    public function render($mixed, array $data = [], array $merge = []): Response
    {
        $view = view($mixed, $data, $merge);

        $response = new Response($view);

        if (!empty($this->cookies))
        {
            foreach ($this->cookies as $cookie)
            {
                $response->withCookie($cookie);
            }
        }

        return $response;

    }

    /**
     * @param array ...$arguments
     */
    public function setCookie(...$arguments)
    {
        if (!isset($arguments[2]))
        {
            $arguments[2] = Carbon::now()->addYear();
        }

        $this->cookies[] = \cookie(...$arguments);
    }

}

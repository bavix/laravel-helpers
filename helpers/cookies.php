<?php

use Illuminate\Support\Facades\Cookie;

if (!function_exists('bx_decrypt'))
{
    function bx_decrypt($mixed)
    {
        try
        {
            return decrypt($mixed);
        }
        catch (\Throwable $throwable)
        {
            return $mixed;
        }
    }
}

if (!function_exists('bx_cookie'))
{
    function bx_cookie($key, $default = null)
    {
        $data = Cookie::get($key, $default);

        if (is_array($data))
        {
            return array_map('bx_decrypt', $data);
        }

        return bx_decrypt($data);
    }
}

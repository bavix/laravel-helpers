<?php

if (!function_exists('bx_swap'))
{
    function bx_swap(&$first, &$second)
    {
        $data   = $first;
        $first  = $second;
        $second = $data;
    }
}

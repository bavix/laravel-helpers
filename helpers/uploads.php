<?php

if (!function_exists('bx_uploaded_file'))
{
    function bx_uploaded_file()
    {
        return function (\Illuminate\Http\UploadedFile $file) {

            $builder = \Bavix\SDK\PathBuilder::sharedInstance();
            $name    = \Bavix\Helpers\Str::random();
            $hash    = $builder->hash($name);

            return $hash . '/' . $name . '.' . $file->clientExtension();
        };
    }
}

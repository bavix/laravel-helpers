<?php

/**
 * This expansion is necessary when using the laravel-admin component.
 */

namespace Bavix\Exceptions;

use Illuminate\Support\Facades\Storage;
use Bavix\Helpers\PregMatch;

trait ModelFile
{
    public function setFileAttribute($path)
    {
        if (empty($path))
        {
            return;
        }

        $this->path = $path;
        $this->type = PregMatch::first('~\.(\w+)$~', $path)->matches[1] ?? null;
        $this->size = Storage::disk($this->storageDisk)->size($path);
    }
}

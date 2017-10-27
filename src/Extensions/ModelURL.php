<?php

namespace Bavix\Extensions;

use Bavix\Helpers\Str;

trait ModelURL
{

    public function url()
    {
        return route($this->route, ...$this->urlArguments());
    }

    public function urlArguments(): array
    {
        return [
            $this->id,
            Str::friendlyUrl($this->title)
        ];
    }

}

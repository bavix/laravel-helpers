<?php

namespace Bavix\Exceptions;

use Spatie\Tags\HasTags;

trait ModelTag
{
    use HasTags;

    public function setTagAttribute($string)
    {
        $tags = \explode(',', $string);

        if (!$this->exists)
        {
            $this->setTagsAttribute($tags);

            return;
        }

        $this->syncTags($tags);
    }
}

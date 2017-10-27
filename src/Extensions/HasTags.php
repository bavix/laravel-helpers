<?php

namespace Bavix\Exceptions;

use Spatie\Tags\Tag;

trait HasTags
{

    use \Spatie\Tags\HasTags;

    public static function getTagClassName(): string
    {
        if (class_exists(App\Models\Tag::class))
        {
            return App\Models\Tag::class;
        }

        return Tag::class;
    }

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

<?php

namespace Bavix\App\Models;

use Encore\Admin\Form\Field\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait MultipleImageTrait
{

    use ImageTrait;

    /**
     * @return MorphToMany|HasMany
     */
    abstract public function images();

    /**
     * @param array $pictures
     */
    public function setGalleryAttribute(array $pictures)
    {
        foreach ($pictures as $picture)
        {
            $this->setPictureAttribute($picture, false);
        }
    }

}

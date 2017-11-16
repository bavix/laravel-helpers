<?php

namespace Bavix\App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ImageTrait
{

    /**
     * @return string
     */
    abstract public function getModelImage(): string;

    /**
     * @return BelongsTo
     */
    abstract public function image(): BelongsTo;

    /**
     * @return string
     */
    public function getPictureAttribute()
    {
        return $this->image->path;
    }

    /**
     * @param string $picture
     * @param bool   $toModel
     */
    public function setPictureAttribute($picture, $toModel = true)
    {
        $class       = $this->getModelImage();
        $model       = new $class();
        $model->path = $picture;
        $model->save();

        $this->id or $this->save();

        if (!$toModel)
        {
            $this->images()->save($model);

            return;
        }

        $this->image_id = $model->id;
        $this->save();
    }

}

<?php

namespace Bavix\App\Models;

trait ImageTrait
{

    /**
     * @return string
     */
    abstract public function getModelImage(): string;

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

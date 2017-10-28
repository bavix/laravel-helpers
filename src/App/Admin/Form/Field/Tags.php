<?php

namespace Bavix\App\Admin\Form\Field;

class Tags extends \Encore\Admin\Form\Field\Tags
{

    protected $values = [];

    public function values(array $values)
    {
        $this->values = $values;

        return $this;
    }

    public function variables()
    {
        return \array_merge(parent::variables(), [
            'options' => $this->options,
            'values'  => $this->values
        ]);
    }

}

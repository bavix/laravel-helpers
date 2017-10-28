<?php

namespace Bavix\App\Admin\Actions;

class PreviewButton extends DefaultButton
{
    protected $icon = 'fa-eye';

    protected $attributes = [
        'taget' => '_blank'
    ];
}

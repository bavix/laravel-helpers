<?php

namespace Bavix\App\Admin\Actions;

use Bavix\App\Admin\Interfaces\Action;

abstract class DefaultButton implements Action
{

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Font Awesome Icon
     *
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $uri;

    /**
     * DefaultButton constructor.
     *
     * @param       $uri
     * @param array $attributes
     */
    public function __construct($uri, array $attributes = [])
    {
        $this->uri        = $uri;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $attributes = [];

        foreach ($this->attributes as $name => $data)
        {
            $attributes[] = $name . '="' . implode(' ', $data) . '"';
        }

        return '<a href="' . $this->uri . '" ' . implode(' ', $attributes) . '>
            <i class="fa ' . $this->icon . '"></i>
        </a>';
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }

}

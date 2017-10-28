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
     * @param string $uri
     * @param array  $attributes
     */
    public function __construct($uri, array $attributes = null)
    {
        $this->uri = $uri;

        if ($attributes)
        {
            $this->attributes = $attributes;
        }
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $attributes = [];

        foreach ($this->attributes as $name => $data)
        {
            $attributes[] = $name . '="' . implode(' ', (array)$data) . '"';
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

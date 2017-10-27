<?php

namespace Bavix\App\Admin\Interfaces;

interface Action
{
    /**
     * @return string
     */
    public function render(): string;

    /**
     * @return string
     */
    public function __toString(): string;
}

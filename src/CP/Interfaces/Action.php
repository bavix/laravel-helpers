<?php

namespace Bavix\CP\Interfaces;

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

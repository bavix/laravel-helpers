<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$slice = new \Bavix\Slice\Slice([
    'disk'   => 'public',
    'driver' => 'gd'
]);

$corundum = new \Bavix\Helpers\Corundum\Corundum($slice);
$adapter  = new \Bavix\Helpers\Corundum\Adapters\None(
    $corundum,
    __DIR__ . '/images/test.png'
);

$slice = new Bavix\Slice\Slice([
    'width'  => '600',
    'height' => '600',
    'color'  => '#f00'
]);

$adapter->apply($slice)
    ->save(__DIR__ . '/images/none.png');

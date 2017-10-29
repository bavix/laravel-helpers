<?php

namespace Bavix\Helpers\Corundum;

use Bavix\Helpers\Corundum\Corundum;
use Bavix\Slice\Slice;
use Intervention\Image\Image;

interface DriverInterface
{

    /**
     * DriverInterface constructor.
     *
     * @param Corundum $corundum
     * @param string   $path
     */
    public function __construct(Corundum $corundum, string $path);

    /**
     * @param Slice $slice
     *
     * @return Image
     */
    public function apply(Slice $slice): Image;

}

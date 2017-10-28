<?php

namespace Bavix\Helpers\Image\Adapters;

use Bavix\Helpers\Corundum\DriverInterface;
use Bavix\Helpers\Image\Corundum;
use Bavix\Slice\Slice;
use Intervention\Image\Image;

abstract class Adapter implements DriverInterface
{

    /**
     * @var Corundum
     */
    protected $corundum;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var string
     */
    protected $path;

    /**
     * Adapter constructor.
     *
     * @param Corundum $corundum
     * @param string   $path
     */
    public function __construct(Corundum $corundum, string $path)
    {
        $this->corundum = $corundum;
        $this->path     = $path;
    }

    /**
     * @param Image $image
     * @param Slice $config
     * @param bool  $minimal
     *
     * @return Slice
     */
    protected function received(Image $image, Slice $config, $minimal = true): Slice
    {
        $width  = (int)$config->getRequired('width');
        $height = (int)$config->getRequired('height');

        $shiftWidth  = 0;
        $shiftHeight = 0;

        $_width  = $width;
        $_height = $height;

        if ($image->height() < $image->width())
        {
            $_height     = $image->height() * $width / $image->width();
            $shiftHeight = ($_height - $height) / 2;
        }
        else
        {
            $_width     = $image->width() * $height / $image->height();
            $shiftWidth = ($_width - $width) / 2;
        }

        if ($minimal ^ $_width > $width)
        {
            $_height = $_height * $width / $_width;
            $_width  = $width;
        }

        if ($minimal ^ $_height > $height)
        {
            $_width  = $_width * $height / $_height;
            $_height = $height;
        }

        return new Slice([
            'config'   => [
                'width'  => $width,
                'height' => $height,
            ],
            'received' => [
                'width'  => (int)$_width,
                'height' => (int)$_height,
            ],
            'shift'    => [
                'width'  => (int)$shiftWidth,
                'height' => (int)$shiftHeight,
            ]
        ]);
    }

    /**
     * @param Image         $image
     * @param Slice         $slice
     * @param \ImagickPixel $pixel
     *
     * @return Image
     */
    protected function handler(Image $image, Slice $slice, \ImagickPixel $pixel = null): Image
    {
        $pixel = $this->pixel($pixel);

        $image->resize(
            $slice->getRequired('received.width'),
            $slice->getRequired('received.height')
        );

        $image->resizeCanvas(
            $width = $slice->getRequired('config.width'),
            $height = $slice->getRequired('config.height'),
            'center',
            false,
            $pixel
        );

        $fill = $this->corundum
            ->imageManager()
            ->canvas($width, $height, $pixel);

        $fill->fill(
            $image,
            $slice->getRequired('shift.width'),
            $slice->getRequired('shift.height')
        );

        return $fill;
    }

    /**
     * @return Image
     */
    protected function image(): Image
    {
        if (!$this->image)
        {
            $this->image = $this->corundum->createImage($this->path);
        }

        return $this->image;
    }

    /**
     * @param \ImagickPixel $pixel
     *
     * @return \ImagickPixel
     */
    protected function pixel(\ImagickPixel $pixel = null): \ImagickPixel
    {
        if (!$pixel)
        {
            return new \ImagickPixel('rgba(0, 0, 0, 0)');
        }

        return $pixel;
    }

}

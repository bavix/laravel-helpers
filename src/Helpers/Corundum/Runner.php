<?php

namespace Bavix\Helpers\Corundum;

use Bavix\Exceptions\Invalid;
use Bavix\Helpers\Dir;
use Bavix\Helpers\File;
use Bavix\Slice\Slice;

class Runner
{

    /**
     * @var Corundum
     */
    protected $corundum;

    public function __construct(Corundum $corundum)
    {
        $this->corundum = $corundum;
    }

    /**
     * @param string $path
     * @param string $thumbnail
     *
     * @return string
     */
    public function thumbnail(string $path, string $thumbnail): string
    {
        // original  = /<user>/original/xx/yy/xxyyzzzz.<format>
        $fullPath = preg_replace(
            '~/' . $this->corundum->type() . '/~',
            '/' . $thumbnail . '/',
            $path
        );

        Dir::make(dirname($fullPath));

        return $fullPath;
    }

    /**
     * @param Slice $slice
     *
     * @return string
     */
    protected function type(Slice $slice): string
    {
        return $slice->getRequired('type');
    }

    /**
     * @param string $type
     * @param string $path
     *
     * @return DriverInterface
     *
     * @throws Invalid
     */
    protected function adapter(string $type, string $path): DriverInterface
    {
        if (!$this->corundum->exists($type))
        {
            throw new Invalid('Unknown type `' . $type . '`');
        }

        return $this->corundum->{$type}($path);
    }

    /**
     * @return array
     */
    public function config(): array
    {
        return \config('corundum');
    }

    /**
     * @param string $path
     * @param bool   $checkExists
     *
     * @throws Invalid
     */
    public function apply(string $path, $checkExists = false)
    {
        foreach ($this->config() as $name => $config)
        {
            $slice = new Slice($config);
            $type  = $this->type($slice);
            $path  = $this->thumbnail(
                $this->corundum->imagePath($path), 
                $name
            );
            
            if ($checkExists && File::isFile($path))
            {
                continue;
            }

            $this->adapter($type, $path)
                ->apply($slice)
                ->save(
                    $path,
                    $slice->getData('quality')
                );
        }
    }

}

<?php

namespace Bavix\Helpers\Corundum;

use Bavix\Exceptions\Invalid;
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
        return preg_replace(
            '~/' . $this->corundum->type() . '/~',
            '/' . $thumbnail . '/',
            $path
        );
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
     *
     * @throws Invalid
     */
    public function apply(string $path)
    {
        foreach ($this->config() as $name => $config)
        {
            $slice = new Slice($config);
            $type  = $this->type($slice);

            $this->adapter($type, $path)
                ->apply($slice)
                ->save(
                    $this->thumbnail($path, $name),
                    $slice->getData('quality')
                );
        }
    }

}

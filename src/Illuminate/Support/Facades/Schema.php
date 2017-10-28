<?php

namespace Bavix\Illuminate\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Bavix\Illuminate\Database\Schema\Blueprint;

/**
 * @method static \Illuminate\Database\Schema\Builder create(string $table, \Closure $callback)
 * @method static \Illuminate\Database\Schema\Builder drop(string $table)
 * @method static \Illuminate\Database\Schema\Builder dropIfExists(string $table)
 * @method static \Illuminate\Database\Schema\Builder table(string $table, \Closure $callback)
 *
 * @see \Illuminate\Database\Schema\Builder
 */
class Schema extends Facade
{

    /**
     * @param string|null $name
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function schemaBuilder($name = null)
    {
        /**
         * @var $db \Illuminate\Database\DatabaseManager
         */
        $db = static::$app['db'];

        $builder = $db->connection($name)->getSchemaBuilder();

        $builder->blueprintResolver(function ($table, $callback) {
            return new Blueprint($table, $callback);
        });

        return $builder;
    }

    /**
     * Get a schema builder instance for a connection.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Schema\Builder
     */
    public static function connection($name)
    {
        return static::schemaBuilder($name);
    }

    /**
     * Get a schema builder instance for the default connection.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return static::schemaBuilder();
    }

}

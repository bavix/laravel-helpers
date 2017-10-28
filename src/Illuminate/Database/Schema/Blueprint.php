<?php

namespace Bavix\Illuminate\Database\Schema;

use Illuminate\Support\Facades\DB;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{

    /**
     * @param string $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function mediumText($column)
    {
        // This magic cleanly and is mediumText!
        return $this->string($column, 16777215);
    }

    /**
     * @param int $precision
     *
     * @return \Illuminate\Support\Fluent
     */
    public function createdAt($precision = 0)
    {
        return $this->timestamp('created_at', $precision)
            ->default(DB::raw('CURRENT_TIMESTAMP'));
    }

    /**
     * @param int $precision
     *
     * @return \Illuminate\Support\Fluent
     */
    public function updatedAt($precision = 0)
    {
        return $this->timestamp('updated_at', $precision)
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    }

    /**
     * @param int $precision
     *
     * @return $this
     */
    public function timestamps($precision = 0)
    {
        $this->createdAt($precision);
        $this->updatedAt($precision);

        return $this;
    }

}

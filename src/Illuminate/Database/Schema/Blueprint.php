<?php

namespace Bavix\Illuminate\Database\Schema;

use Illuminate\Support\Facades\DB;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{

    /**
     * @param int $precision
     *
     * @return $this
     */
    public function createdAt($precision = 0)
    {
        $this->timestamp('created_at', $precision)
            ->default(DB::raw('CURRENT_TIMESTAMP'));

        return $this;
    }

    /**
     * @param int $precision
     *
     * @return $this
     */
    public function updatedAt($precision = 0)
    {
        $this->timestamp('updated_at', $precision)
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        return $this;
    }

    /**
     * @param int $precision
     *
     * @return $this
     */
    public function timestamps($precision = 0)
    {
        return $this->createdAt($precision)->updatedAt($precision);
    }

}

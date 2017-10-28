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
    public function timestamps($precision = 0)
    {
        $this->timestamp('created_at', $precision)
            ->default(DB::raw('CURRENT_TIMESTAMP'));

        $this->timestamp('updated_at', $precision)
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        return $this;
    }

}

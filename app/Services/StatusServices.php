<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class StatusServices {

    /**
     * Récupère la liste des status par type.
     * @param $type
     * @return list des status
     */
    public static function getStatusByType($type) {

        $statuses = DB::table('statuses')->where('type', $type)->get();

        return $statuses;
    }
}

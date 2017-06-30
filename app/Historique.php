<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    //
    protected $fillable = [
        'client_id', 'employe_id', 'status_id', 'description', 'date'
    ];

    public function client() {
        $this->hasOne('\App\User', 'client_id');
    }

    public function employe() {
        $this->hasOne('\App\User', 'employe_id');
    }

    public function etat() {
        $this->hasOne('\App\Status', 'status_id');
    }

}

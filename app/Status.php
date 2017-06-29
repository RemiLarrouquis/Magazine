<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable = [
        'type', 'libelle', 'libelle_short',
    ];

    public function user() {
        $this->hasMany('\App\User');
    }
}

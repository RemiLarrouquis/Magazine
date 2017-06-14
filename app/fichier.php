<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fichier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_fichier', 'nom_server',
    ];

    public function defi() {
        return $this -> hasMany('App\Publication');
    }
}

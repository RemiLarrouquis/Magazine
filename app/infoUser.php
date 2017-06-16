<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    //
    protected $fillable = [
        'user_id', 'nom', 'prenom', 'sexe_id', 'date_naissance', 'lieu_naissance', 'adresse', 'code_postal', 'telephone',
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function sexe()
    {
        return $this->hasOne('App\Status', 'sexe_id');
    }
}

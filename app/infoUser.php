<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    //
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'sexe_id', 'date_naissance', 'lieu_naissance', 'adresse', 'code_postal', 'telephone',
    ];

    protected $hidden = [
        'password',
    ];

    public function sexe()
    {
        return $this->hasOne('App\Status', 'sexe_id');
    }
}

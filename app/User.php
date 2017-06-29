<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'email', 'password', 'prenom', 'mail_confirm', 'is_client', 'sexe_id', 'date_naissance', 'lieu_naissance', 'adresse', 'code_postal', 'telephone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function abonnements() {
        $this->hasMany('\App\Abonnement');
    }

    public function sexe() {
        $this->belongsTo('\App\Status', 'sexe_id');
    }

}

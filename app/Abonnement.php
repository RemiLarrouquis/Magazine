<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    //
    protected $fillable = [
        'precedent_id', 'publication_id', 'client_id', 'etat_id', 'paye_id', 'date_fin', 'date_pause',
    ];

    public function precedent() {
        $this->hasOne('\App\Abonnement', 'precedent_id');
    }

    public function publication() {
        $this->hasOne('\App\Publication', 'publication_id');
    }

    public function client() {
        $this->hasOne('\App\InfoUser', 'client_id');
    }

    public function etat() {
        $this->hasOne('\App\Status', 'etat_id');
    }

    public function paye() {
        $this->hasOne('\App\Status', 'paye_id');
    }

}

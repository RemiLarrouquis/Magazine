<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'titre', 'nb_an', 'prix_an', 'description',
    ];

}

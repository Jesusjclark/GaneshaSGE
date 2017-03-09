<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musuario extends Model
{
   protected $fillable = [
        'ci_usu', 'nom_usu', 'ape_usu', 'correo', 'tlf', 'password',	];
}

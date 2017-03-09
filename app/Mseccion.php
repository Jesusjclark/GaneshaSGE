<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mseccion extends Model
{
   protected $fillable = [
        'cod_sec', 'turno', 'cod_pen_sec',	];
}

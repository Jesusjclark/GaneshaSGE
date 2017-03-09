<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mestudiante extends Model
{

   protected $fillable = [
        'ci_est', 'nom_est', 'ape_est', 'cod_pnf_est',	];
}

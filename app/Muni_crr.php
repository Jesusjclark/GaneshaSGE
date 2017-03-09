<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muni_crr extends Model
{
	    protected $fillable = [
        'cod_uc_pnf', 'cod_uc_nac','creditos','nom_uc','trayecto','hta','htt','hte','periodo','cod_pen_uc',	];
}

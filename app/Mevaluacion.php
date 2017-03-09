<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mevaluacion extends Model
{
   protected $fillable = [
        'id_eva', 'id_plan_eva', 'id_inst_eva', 'criterio', 'observacion', 'fec_prop', 'fec_res', 'fec_part', 'corte', 'contenido',	];
}

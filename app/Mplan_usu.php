<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mplan_usu extends Model
{
    protected $fillable = [
        'id_plan_usu', 'id_plan_tpu', 'ci_usu_tpu',	];
}
